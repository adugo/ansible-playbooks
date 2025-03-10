<?php include("backEnd/appHeader.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú de Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap 5 CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        /* Alertas personalizadas: texto blanco para todos los tipos */
        .custom-alert-success {
            background-color: rgba(0,123,255,0.8) !important;
            border-color: rgba(0,123,255,0.8) !important;
            color: #fff;
        }
        .custom-alert-error {
            background-color: rgba(220,53,69,0.8) !important;
            border-color: rgba(220,53,69,0.8) !important;
            color: #fff;
        }
        .custom-alert-alert {
            background-color: rgba(255,193,7,0.8) !important;
            border-color: rgba(255,193,7,0.8) !important;
            color: #fff;
        }
        .custom-alert-app {
            background-color: rgba(51,102,153,0.8) !important;
            border-color: rgba(165,165,165,0.8) !important;
            color: #fff;
        }
        /* Contenedor principal: ocupa el alto descontando la navbar (56px) */
        .full-height {
            min-height: calc(100vh - 56px);
        }
        /* Estilos para las tarjetas de opciones */
        .card-option {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-option:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card-option .card-body {
            padding: 2rem;
        }
        .card-option i {
            color: #0d6efd; /* Color azul de Bootstrap */
            margin-bottom: 1rem;
        }
        .card-option h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .card-option p {
            font-size: 1rem;
            color: #6c757d; /* Color gris de Bootstrap */
            margin-bottom: 1.5rem;
        }
        .btn-option {
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        .btn-option:hover {
            background-color: rgba(13, 110, 253, 0.9); /* Azul más oscuro al pasar el mouse */
        }
        /* Estilos para el título y descripción */
        .display-4 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0d6efd; /* Azul de Bootstrap */
        }
        .lead {
            font-size: 1.25rem;
            color: #6c757d; /* Gris de Bootstrap */
        }
        /* Estilos para el botón de cerrar sesión */
        .btn-logout {
            font-size: 1.2rem;
            padding: 10px 25px;
            border-radius: 25px;
            background-color: #dc3545; /* Rojo de Bootstrap */
            border: none;
            color: white;
            transition: background-color 0.3s ease;
            width: 100%; /* Ocupa todo el ancho disponible en móviles */
            margin-top: 20px; /* Espacio superior en móviles */
        }
        .btn-logout:hover {
            background-color: #c82333; /* Rojo más oscuro al pasar el mouse */
        }
        /* Ajustes para pantallas grandes */
        @media (min-width: 768px) {
            .btn-logout {
                width: auto; /* Ancho automático en pantallas grandes */
                margin-top: 0; /* Sin margen superior en pantallas grandes */
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%); /* Centrado vertical */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar responsiva -->
    <?php include("view/nav.php"); ?>

    <!-- Contenedor del mensaje centrado -->
    <div class="container full-height d-flex justify-content-center align-items-center">
        <div class="row w-100 position-relative"> <!-- Contenedor relativo para posicionar el botón -->
            <div class="col-12 col-md-8 text-center">
                <!-- Nuevo contenido -->
                <h1 class="display-4 mb-4">Panel de Administración</h1>
                <p class="lead mb-5">Selecciona una de las siguientes opciones para continuar:</p>
                <div class="row justify-content-center">
                    <!-- Opción 1: Acceder a cPanel -->
                    <div class="col-md-5 mb-4">
                        <div class="card card-option h-100">
                            <div class="card-body text-center p-5">
                                <i class="fas fa-cogs fa-4x mb-4"></i>
                                <h3 class="card-title mb-3">Acceder a APanel</h3>
                                <p class="card-text mb-4">
                                    Gestiona tu hosting, correos electrónicos, bases de datos y más desde el panel de control.
                                </p>
                                <a href="./install.php" class="btn btn-primary btn-option">
                                    <i class="fas fa-sign-in-alt me-2"></i> Acceder
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Opción 2: Sacar copia de seguridad -->
                    <div class="col-md-5 mb-4">
                        <div class="card card-option h-100">
                            <div class="card-body text-center p-5">
                                <i class="fas fa-database fa-4x mb-4"></i>
                                <h3 class="card-title mb-3">Copia de Seguridad</h3>
                                <p class="card-text mb-4">
                                    Realiza una copia de seguridad de tu sitio web y datos importantes de manera segura.
                                </p>
                                <a href="./export.php" class="btn btn-success btn-option">
                                    <i class="fas fa-download me-2"></i> Generar Copia
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botón de Cerrar Sesión -->


            
            <form action="backEnd/mngSession.php" method="post" class="d-flex align-items-center">
                        <input type="hidden" name="op" value="sc">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                        <button class="btn btn-logout" onclick="window.location.href='logout.php'">
                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                        </button>
                    </form>



        </div>
    </div>

    <!-- Modal para gestionar cuenta -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="update_account.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountModalLabel">Gestionar cuenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" 
                                aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Nombre de usuario -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>" required>
                        </div>
                        <!-- Contraseña (opcional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Dejar en blanco para mantener la actual">
                        </div>
                        <!-- Idioma -->
                        <div class="mb-3">
                            <label for="language" class="form-label">Idioma</label>
                            <select class="form-select" id="language" name="language">
                                <option value="es" <?php echo ((($_SESSION['language'] ?? '') === 'es') ? 'selected' : ''); ?>>Español</option>
                                <option value="en" <?php echo ((($_SESSION['language'] ?? '') === 'en') ? 'selected' : ''); ?>>Inglés</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery y Bootstrap Bundle (Popper incluido) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>