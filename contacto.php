<?php
$titulo_pagina = "Contacto";
require_once 'includes/header.php';

?>
<!DOCTYPE html>
<body>
    <div class="container mt-4">
        <h1><?php echo $titulo_pagina; ?></h1>
        <p>Envíanos tus comentarios o preguntas.</p>
        <hr>

        <form action="procesar_contacto.php" method="POST" id="formContacto">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" required>
            </div>
            <div class="mb-3">
                <label for="comentario" class="form-label">Comentario</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </form>

    </div>

</body>
</html>
<?php
require_once 'includes/footer.php';
?>