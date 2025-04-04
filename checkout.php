<?php
session_start();
require_once 'includes/db_connect.php';

$carrito = $_SESSION['cart'] ?? [];

if (empty($carrito)) {
    $_SESSION['flash_message'] = "Tu carrito está vacío. No se puede procesar el pago.";
    header('Location: carrito.php');
    exit;
}

$num_orden = 'ORD-' . uniqid() . '-' . date('His');

$id_tienda = '7066'; 

$pdo->beginTransaction();

try {
    $sql_venta = "INSERT INTO ventas (id_tienda, num_orden, fecha) VALUES (?, ?, NOW())";
    $stmt_venta = $pdo->prepare($sql_venta);
    $stmt_venta->execute([$id_tienda, $num_orden]);

    $sql_detalle = "INSERT INTO detalle_venta (id_tienda, num_orden, id_titulo, cantidad, descuento) VALUES (?, ?, ?, ?, ?)";
    $stmt_detalle = $pdo->prepare($sql_detalle);

    $descuento_aplicado = 0;

    foreach ($carrito as $id_titulo => $item) {
        $cantidad = (int)$item['cantidad'];
        $stmt_detalle->execute([$id_tienda, $num_orden, $id_titulo, $cantidad, $descuento_aplicado]);
    }

    $pdo->commit();

    unset($_SESSION['cart']); 

    $_SESSION['flash_message'] = "¡Gracias por tu compra! Tu número de orden es: " . htmlspecialchars($num_orden);
    header('Location: gracias.php?orden=' . urlencode($num_orden));
    exit;

} catch (PDOException $e) {
    $pdo->rollBack();

    error_log("Error en Checkout: " . $e->getMessage());

    $_SESSION['flash_message'] = "Error al procesar tu pedido. Por favor, inténtalo de nuevo o contacta con soporte.";
    header('Location: carrito.php');
    exit;
}
?>