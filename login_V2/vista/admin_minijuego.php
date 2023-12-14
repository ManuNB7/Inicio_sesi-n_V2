<?php if(isset($_SESSION['perfil']) && $_SESSION["perfil"]=="a"){?>
    <h1>Bienvenido <?php echo $_SESSION["nombre"] ?>, página de administración de minijuego.</h1>
<?php } else { ?>
    <h1>Para acceder, primero inicia sesión.</h2>
<?php } ?>