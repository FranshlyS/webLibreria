<?php
require_once 'includes/db_connect.php';
$titulo_pagina = "Catálogo de Libros";
require_once 'includes/header.php';
?>

<div class="container mt-4">
    <h1><i class="fas fa-book me-2"></i><?php echo $titulo_pagina; ?></h1>
    <hr>

    <?php
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo $_SESSION['flash_message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['flash_message']);
    }
    ?>

    <div class="table-responsive"> 
        <?php
        try {
            $sql = "SELECT id_titulo, titulo, tipo, precio, total_ventas, notas FROM titulos ORDER BY titulo ASC";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                echo '<table id="tablaLibros" class="table table-striped table-bordered table-hover" style="width:100%">';
                echo '<thead class="table-dark">';
                echo '<tr><th>Título</th><th>Tipo</th><th>Precio</th><th>Notas</th><th>Acciones</th></tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($libro = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($libro['titulo']) . '</td>';
                    echo '<td>' . htmlspecialchars($libro['tipo']) . '</td>';
                    $precio_valido = $libro['precio'] !== null && $libro['precio'] > 0;
                    $precio_formateado = $precio_valido ? '$' . number_format($libro['precio'], 2) : 'No disponible';
                    echo '<td>' . htmlspecialchars($precio_formateado) . '</td>';
                    echo '<td>' . htmlspecialchars($libro['notas']) . '</td>';
                    echo '<td>';
                    if ($precio_valido) {
                        echo '<form action="cart_action.php" method="POST" class="d-inline">';
                        echo '<input type="hidden" name="id_titulo" value="' . htmlspecialchars($libro['id_titulo']) . '">';
                        echo '<input type="hidden" name="action" value="add">';
                        echo '<button type="submit" class="btn btn-success btn-sm add-to-cart-btn" title="Añadir al carrito">';
                        echo '<i class="fas fa-cart-plus"></i>';
                        echo '</button>';
                        echo '</form>';
                    } else {
                        echo '<button class="btn btn-secondary btn-sm" disabled title="No disponible para compra">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</button>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="alert alert-warning" role="alert">No se encontraron libros en la base de datos.</div>';
            }
        } catch (\PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Error al consultar los libros: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>