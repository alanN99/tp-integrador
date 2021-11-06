<?php
require_once '../clases/Usuario.php';
require_once '../clases/Factura.php';
require_once '../clases/RepositorioFactura.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);   
    $factura = new Factura($usuario, $_POST['nombre'], $_POST['apellido'], $_POST['detalle'], $_POST['importe'], $_POST['ciudad'], $_POST['calle'], $_POST['altura']);
    $rc = new RepositorioFactura();
    $numero = $rc->store($factura);
    if($numero === false) {
        $mensaje = "Error al agregar factura";        
    } else{
        $factura->setNumero($numero);
        $mensaje = "Factura agregada correctamente";
    }
    header('Location: ../home.php?mensaje=$mensaje');

} else {
    header('Location: index.php');
}
?>

