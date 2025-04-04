<?php
$titulo_pagina = "Inicio";
require_once 'includes/header.php';
?>

<div class="container mt-4"> 
    <div class="p-5 mb-4 bg-body-tertiary rounded-3 shadow-sm">
        <div class="container-fluid py-5">
            <h1 class="display-4 fw-bold text-primary">
                <i class="fas fa-book-open-reader me-2"></i>Bienvenido a Librería Moderna
            </h1>
            <p class="col-md-9 fs-4 mt-3">
                Explora nuestro catálogo interactivo de libros y autores. Un proyecto que demuestra la integración
                de tecnologías web modernas como PHP, MySQL con PDO, Bootstrap 5 y DataTables.
            </p>
            <div class="mt-4">
                <a href="libros.php" class="btn btn-primary btn-lg me-2" type="button">
                    <i class="fas fa-search me-1"></i> Ver Libros
                </a>
                <a href="autores.php" class="btn btn-secondary btn-lg" type="button">
                    <i class="fas fa-users me-1"></i> Ver Autores
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title h4 text-primary"><i class="fas fa-info-circle me-2"></i>Sobre el Proyecto</h2>
                    <p class="card-text flex-grow-1">
                        Este portal web es el resultado del proyecto final del curso de Programación Web.
                        Permite consultar dinámicamente información de la base de datos "Librería",
                        presentada en tablas interactivas y con un formulario de contacto funcional
                        conectado a la base de datos mediante PDO para máxima seguridad y eficiencia.
                    </p>
                    <a href="contacto.php" class="btn btn-outline-primary mt-auto" type="button">
                        <i class="fas fa-envelope me-1"></i> Contáctanos
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                 <div class="card-body d-flex flex-column">
                    <h2 class="card-title h4 text-secondary"><i class="fas fa-cogs me-2"></i>Tecnologías Utilizadas</h2>
                    <ul class="list-group list-group-flush flex-grow-1">
                        <li class="list-group-item"><i class="fab fa-html5 me-2 text-danger"></i>HTML5 y CSS3</li>
                        <li class="list-group-item"><i class="fab fa-bootstrap me-2 text-primary"></i>Bootstrap 5</li>
                        <li class="list-group-item"><i class="fas fa-table me-2 text-info"></i>DataTables.net</li>
                        <li class="list-group-item"><i class="fab fa-js-square me-2 text-warning"></i>JavaScript (jQuery)</li>
                        <li class="list-group-item"><i class="fab fa-php me-2 text-info"></i>PHP 8+</li>
                        <li class="list-group-item"><i class="fas fa-database me-2 text-success"></i>MySQL & PDO</li>
                    </ul>
                 </div>
            </div>
        </div>
    </div>

</div>

<?php
require_once 'includes/footer.php';
?>