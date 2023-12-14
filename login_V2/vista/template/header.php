<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $controlador->titulo ?></title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
    <?php if (!empty($_SESSION)) { ?>
        <nav>
            <a href="index.php?controller=sesion&action=cerrar_sesion">Cerrar sesión</a>
        </nav>
    <?php } ?>
    <main>