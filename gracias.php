<?php
$titulo_pagina = "Compra Exitosa";
require_once 'includes/header.php';

$num_orden = isset($_GET['orden']) ? htmlspecialchars($_GET['orden']) : 'No especificado';
?>

<div class="container mt-4">
    <div class="alert alert-success text-center" role="alert">
        <h4 class="alert-heading"><i class="fas fa-check-circle"></i> ¡Compra Realizada con Éxito!</h4>
        <p>Gracias por tu pedido en Librería Moderna.</p>
        <hr>
        <p class="mb-0">Tu número de orden de referencia es: <strong><?php echo $num_orden; ?></strong></p>
    </div>

     <?php
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="alert alert-info mt-3">';
        echo $_SESSION['flash_message'];
        echo '</div>';
        unset($_SESSION['flash_message']);
    }
    ?>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">
            <i class="fas fa-home me-1"></i> Volver al Inicio
        </a>
        <a href="libros.php" class="btn btn-secondary">
            <i class="fas fa-book me-1"></i> Seguir Viendo Libros
        </a>
    </div>

</div>

<?php
require_once 'includes/footer.php';
?>