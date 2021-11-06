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

    $r = $factura->editar($_POST['n'], $_POST['a'], $_POST['d'], $_POST['i'], $_POST['c'], $_POST['ca'], $_POST['al']);    

    if ($r) {
        $rc->actualizarFactura($factura);
        $respuesta['resultado'] = "OK";
    } else {
        $respuesta['resultado'] = "Error al realizar la operación";
    }

    $respuesta['numero_factura'] = $factura->getNumero();
    $respuesta['nombre'] = $factura->getNombre();
    $respuesta['apellido'] = $factura->getApellido();
    $respuesta['detalle'] = $factura->getDetalle();
    $respuesta['importe'] = $factura->getImporte();
    $respuesta['ciudad'] = $factura->getCiudad();
    $respuesta['calle'] = $factura->getCalle();
    $respuesta['altura'] = $factura->getAltura();

    echo json_encode($respuesta);

}

?>