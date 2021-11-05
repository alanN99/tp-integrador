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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container cuerpo" style="">        
            <h1>Crear nueva factura</h1>    
            <form action="nueva_factura.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" placeholder="Ingresar nombre" id="nombre" required> 
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" placeholder="Ingresar apellido" id="apellido" required>                    
                    </div><br>
                    <div class="col-md-6">
                        <label for="detalle">Detalle</label>
                        <input type="text" name="detalle" placeholder="Ingresar descripción" id="detalle" required>
                        <label for="importe">Importe $</label>
                        <input type="number" name="importe" placeholder="Ingresar monto" id="importe" required>
                    </div>                   
                <div>
                <br>                                    
                <div class="row">
                    <div class="col-md-6">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" placeholder="Ingresar Ciudad" id="ciudad" required>
                        <label for="calle">Calle</label>                    
                        <input type="text" name="calle" placeholder="Ingresar calle" id="calle" required>
                        <label for="altura">Altura</label>
                        <input type="number" name="altura" placeholder="Ingresar altura" id="altura" required>
                    </div><br><hr>
                    <div class="col-md-6">                        
                        <input type="submit" value="Crear factura">
                    </div>
                </div>
            </form>        
    </div>
</body>
</html>