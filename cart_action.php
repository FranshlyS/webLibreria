<?php
session_start();
require_once 'includes/db_connect.php';

function redirect_to_cart($message = null) {
    if ($message) {
        $_SESSION['flash_message'] = $message;
    }
    header('Location: carrito.php');
    exit;
}

function redirect_to($location, $message = null) {
     if ($message) {
        $_SESSION['flash_message'] = $message;
    }
    header("Location: $location");
    exit;
}



if (isset($_POST['action_remove'])) {
    $id_titulo_a_eliminar = $_POST['action_remove'];

    if (isset($_SESSION['cart'][$id_titulo_a_eliminar])) {
        $titulo_eliminado = $_SESSION['cart'][$id_titulo_a_eliminar]['titulo'];
        unset($_SESSION['cart'][$id_titulo_a_eliminar]);
        redirect_to_cart('"' . htmlspecialchars($titulo_eliminado) . '" eliminado del carrito.');
    } else {
        redirect_to_cart('Error: Item a eliminar no encontrado en el carrito.');
    }
}

elseif (isset($_POST['action_update'])) {
    if (isset($_POST['cantidad']) && is_array($_POST['cantidad'])) {
        $cantidades_enviadas = $_POST['cantidad'];
        $cambios_realizados = false;

        $carrito_actual = $_SESSION['cart'] ?? [];

        foreach ($carrito_actual as $id_titulo_session => $item_session) {
            if (isset($cantidades_enviadas[$id_titulo_session])) {
                $cantidad_nueva = (int)$cantidades_enviadas[$id_titulo_session];

                if ($cantidad_nueva <= 0) {
                    if (isset($_SESSION['cart'][$id_titulo_session])) {
                       unset($_SESSION['cart'][$id_titulo_session]);
                       $cambios_realizados = true;
                    }
                } elseif ($cantidad_nueva != $item_session['cantidad']) {
                     $_SESSION['cart'][$id_titulo_session]['cantidad'] = $cantidad_nueva;
                     $cambios_realizados = true;
                }
            }
        }
        redirect_to_cart($cambios_realizados ? 'Carrito actualizado.' : 'No se realizaron cambios en las cantidades.');

    } else {
        redirect_to_cart('No se recibieron datos de cantidad para actualizar.');
    }
}

elseif (isset($_POST['action_checkout'])) {
    header('Location: checkout.php');
    exit;
}

elseif (isset($_POST['action']) && $_POST['action'] == 'add' && isset($_POST['id_titulo'])) {
    $id_titulo = $_POST['id_titulo'];
    $cantidad = 1; 

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    try {
        $sql = "SELECT titulo, precio FROM titulos WHERE id_titulo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_titulo]);
        $libro = $stmt->fetch();

        if ($libro && $libro['precio'] !== null && $libro['precio'] > 0) {
            if (isset($_SESSION['cart'][$id_titulo])) {
                $_SESSION['cart'][$id_titulo]['cantidad']++;
                 $_SESSION['flash_message'] = 'Cantidad actualizada.'; 
            } else {
                $_SESSION['cart'][$id_titulo] = [
                    'titulo' => $libro['titulo'],
                    'precio' => (float)$libro['precio'],
                    'cantidad' => $cantidad
                ];
                 $_SESSION['flash_message'] = '"' . htmlspecialchars($libro['titulo']) . '" añadido.';
            }
        } else {
             $_SESSION['flash_message'] = 'Error: Libro no encontrado o no disponible.';
        }
    } catch (PDOException $e) {
         error_log("Error BD (add cart): " . $e->getMessage());
         $_SESSION['flash_message'] = 'Error al procesar.';
    }
    redirect_to('libros.php', $_SESSION['flash_message']);
}


else {
    redirect_to_cart('Acción no reconocida o faltan datos.');
}
?>