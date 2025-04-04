<?php
require_once 'includes/db_connect.php';
$titulo_pagina = "Carrito de Compras";
require_once 'includes/header.php';

$carrito = $_SESSION['cart'] ?? [];
$total_carrito = 0;
?>

<div class="container mt-4">
    <h1><i class="fas fa-shopping-cart me-2"></i><?php echo $titulo_pagina; ?></h1>
    <hr>

    <?php
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
        echo $_SESSION['flash_message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['flash_message']);
    }

    if (empty($carrito)) :
    ?>
        <div class="alert alert-info" role="alert">
            Tu carrito está vacío. ¡<a href="libros.php" class="alert-link">Explora nuestros libros</a>!
        </div>
    <?php else : ?>
        <form action="cart_action.php" method="POST">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col" class="text-center">Precio Unitario</th>
                            <th scope="col" class="text-center">Cantidad</th>
                            <th scope="col" class="text-end">Subtotal</th>
                            <th scope="col" class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrito as $id_titulo => $item) : ?>
                            <?php
                                $titulo = htmlspecialchars($item['titulo']);
                                $precio = (float)$item['precio'];
                                $cantidad = (int)$item['cantidad'];
                                $subtotal = $precio * $cantidad;
                                $total_carrito += $subtotal;
                            ?>
                            <tr class="cart-item-row">
                                <td><?php echo $titulo; ?></td>
                                <td class="text-center">$<?php echo number_format($precio, 2); ?></td>
                                <td class="text-center">
                                    <input type="number" name="cantidad[<?php echo $id_titulo; ?>]" value="<?php echo $cantidad; ?>" min="0" class="form-control form-control-sm quantity-input d-inline-block">
                                </td>
                                <td class="text-end fw-bold">$<?php echo number_format($subtotal, 2); ?></td>
                                <td class="text-center">
                                    <button type="submit" name="action_remove" value="<?php echo $id_titulo; ?>" class="btn btn-danger btn-sm" title="Eliminar del carrito">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end border-0"><strong>Total:</strong></td>
                            <td class="text-end fw-bolder border-0 fs-5">$<?php echo number_format($total_carrito, 2); ?></td>
                            <td class="border-0">
                                <button type="submit" name="action_update" value="update" class="btn btn-primary btn-sm">
                                    <i class="fas fa-sync-alt"></i> Actualizar
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="libros.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Seguir Comprando
                </a>
                <button type="submit" name="action_checkout" value="checkout" class="btn btn-primary btn-lg">
                    <i class="fas fa-credit-card me-1"></i> Proceder al Pago (Simulado)
                </button>
            </div>

        </form> 
    <?php endif;?>
</div>

<?php
require_once 'includes/footer.php';
?>