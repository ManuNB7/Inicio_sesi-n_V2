<?php if(isset($_GET["error"])){ echo "<h2>".$_GET["error"]."</h2>"; } ?>
<h1>Inicio de sesión</h1>
<form action="index.php?controller=sesion&action=inicio_sesion" method="POST">
    <label for="nombre">Correo electrónico o nombre de usuario</label>
    <input type="text" name="nombre" id="nombre">
    <label for="pw">Contraseña</label>
    <input type="password" name="pw" id="pw">
    <input type="submit" name="enviar">
</form>