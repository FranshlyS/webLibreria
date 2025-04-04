<?php
require_once 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = isset($_POST['nombre']) ? strip_tags(trim($_POST['nombre'])) : '';
    $correo = isset($_POST['correo']) ? filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL) : '';
    $asunto = isset($_POST['asunto']) ? strip_tags(trim($_POST['asunto'])) : '';
    $comentario = isset($_POST['comentario']) ? strip_tags(trim($_POST['comentario'])) : '';

    if (!empty($nombre) && !empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($asunto) && !empty($comentario)) {

        $sql = "INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$nombre, $correo, $asunto, $comentario]);

            header("Location: contacto.php?status=success");
            exit;

        } catch (\PDOException $e) {
             header("Location: contacto.php?status=error_db");
             exit;
        }

    } else {
        header("Location: contacto.php?status=invalid_data");
        exit;
    }

} else {
    header("Location: contacto.php");
    exit;
}
?>