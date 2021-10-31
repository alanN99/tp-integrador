<?php
require_once 'clases/Usuario.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nueva factura</title>
</head>
<body>
    <h1>Crear nueva factura</h1>    
    <form action="nueva_factura.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido">
        <label for="detalle">Detalle</label>
        <input type="text" name="detalle" id="detalle">
        <label for="importe">Importe</label>
        <input type="number" name="importe" id="importe">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad">
        <label for="calle">Calle</label>
        <input type="text" name="calle" id="calle">
        <label for="altura">Altura</label>
        <input type="number" name="altura" id="altura">
        <input type="submit" value="Crear factura">
    </form>
</body>
</html>