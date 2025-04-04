<?php
require_once 'includes/db_connect.php';
require_once 'includes/header.php';
$titulo_pagina = "Listado de Autores";
?>
<!DOCTYPE html>
<body>
    <div class="container mt-4">
        <h1><?php echo $titulo_pagina; ?></h1>
        <hr>
        <?php
        try {
            $sql = "SELECT id_autor, apellido, nombre, direccion, ciudad, estado, pais FROM autores ORDER BY apellido ASC, nombre ASC";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                echo '<table id="tablaAutores" class="table table-striped table-bordered table-hover" style="width:100%">';
                echo '<thead class="table-dark">';
                echo '<tr><th>Apellido</th><th>Nombre</th><th>Dirección</th><th>Ciudad</th><th>Estado</th><th>País</th></tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($autor = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($autor['apellido']) . '</td>';
                    echo '<td>' . htmlspecialchars($autor['nombre']) . '</td>';
                    echo '<td>' . htmlspecialchars($autor['direccion']) . '</td>';
                    echo '<td>' . htmlspecialchars($autor['ciudad']) . '</td>';
                    echo '<td>' . htmlspecialchars($autor['estado']) . '</td>';
                    echo '<td>' . htmlspecialchars($autor['pais']) . '</td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
                echo "<p>Total de autores encontrados: " . $stmt->rowCount() . "</p>";
            } else {
                 echo '<div class="alert alert-warning" role="alert">No se encontraron autores.</div>';
            }
        } catch (\PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">Error al consultar los autores: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>
</body>
</html>
<?php
require_once 'includes/footer.php';
?>