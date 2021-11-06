<?php
require_once '../clases/Usuario.php';
require_once '../clases/RepositorioFactura.php';
require_once '../clases/RepositorioUsuario.php';
require_once '../clases/Factura.php';
session_start();
if (isset($_SESSION['usuario']) && isset($_GET['n'])){
    $usuario = unserialize($_SESSION['usuario']);
    $rc = new RepositorioFactura();
    $factura = $rc->get_one($_GET['n']);
    if ( $factura->getIdUsuario() != $usuario->getId()) {
        die("Error: La factura no pertenece al usuario");
    }
    if($rc->delete($factura)) {
        $mensaje = "Factura eliminada con éxito";
    } else{
        $mensaje = "Error al eliminar la factura";
    }
    header("Location: ../home.php?mensaje=$mensaje");
} else {
    header("Location: ../index.php");
}