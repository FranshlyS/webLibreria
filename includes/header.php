<?php
session_start();

$numero_items_carrito = 0;
if (!empty($_SESSION['cart'])) {
    $numero_items_carrito = count($_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' - Librería Moderna' : 'Librería Moderna - Proyecto Final'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .cart-item-row img { max-width: 50px; height: auto; margin-right: 10px; }
        .quantity-input { max-width: 70px; text-align: center; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm" aria-label="Navegación principal">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">
        <i class="fas fa-book-open-reader me-2"></i>Librería Moderna
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">
            <i class="fas fa-home me-1"></i>Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'libros.php') ? 'active' : ''; ?>" href="libros.php">
            <i class="fas fa-book me-1"></i>Libros
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'autores.php') ? 'active' : ''; ?>" href="autores.php">
            <i class="fas fa-users me-1"></i>Autores
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contacto.php') ? 'active' : ''; ?>" href="contacto.php">
            <i class="fas fa-envelope me-1"></i>Contacto
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative <?php echo (basename($_SERVER['PHP_SELF']) == 'carrito.php') ? 'active' : ''; ?>" href="carrito.php" id="cart-link">
            <i class="fas fa-shopping-cart me-1"></i>Carrito
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">
              <?php echo $numero_items_carrito; ?>
              <span class="visually-hidden">items en el carrito</span>
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container-fluid main-container">