<?php
require_once '.env.php';
require_once 'Repositorio.php';
require_once 'Usuario.php';
require_once 'Factura.php';

class RepositorioFactura extends Repositorio
{
    public function store( Factura $factura)
    {        
        $id_usuario =$factura->getIdUsuario();
        $nombre = $factura->getNombre();
        $apellido = $factura->getApellido();
        $detalle = $factura->getDetalle();
        $importe = $factura->getImporte();
        $ciudad = $factura->getCiudad();
        $calle = $factura->getCalle();
        $altura = $factura->getAltura();
        
        $q = "INSERT INTO facturas (id_usuario, nombre, apellido, detalle, importe, ciudad, calle, altura) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        try{
            $query = self::$conexion->prepare($q);
    
            $query->bind_param("ssssissi", $id_usuario, $nombre, $apellido, $detalle, $importe, $ciudad, $calle, $altura);
    
            if ($query->execute()) {
                return self::$conexion->insert_id;
            } else {
                return false;
            }
        } catch (Exception $e){
            return false;
        }
    }

    public function get_all(Usuario $usuario)
    {
        $idUsuario = $usuario->getId();
        $q = "SELECT nombre, apellido, detalle, importe, ciudad, calle, altura, numero FROM facturas WHERE id_usuario = ? ";
        try{
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $idUsuario);
            $query->bind_result($nombre, $apellido, $detalle, $importe, $ciudad, $calle, $altura, $numero);
    
            if ($query->execute()){
                $listaFacturas = array();
                while ($query->fetch()){
                    $listaFacturas[] = new Factura($usuario, $nombre, $apellido, $detalle, $importe, $ciudad, $calle, $altura, $numero);
                }
                return $listaFacturas;
            }
            return false;
        } catch(Exception $e){
            return false;
        }
    }   

    public function get_one($numero)
    {        
        $q = "SELECT nombre, apellido, detalle, importe, ciudad, calle, altura, id_usuario FROM facturas WHERE numero = ? ";
        try{
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $numero);
            $query->bind_result($nombre, $apellido, $detalle, $importe, $ciudad, $calle, $altura, $id_usuario);
    
            if ($query->execute()){
                $listaFacturas = array();
                while ($query->fetch()){
                    $ru = new RepositorioUsuario();
                    $usuario = $ru->get_one($id_usuario);
                    return new Factura($usuario, $nombre, $apellido, $detalle, $importe, $ciudad, $calle, $altura, $numero);
                }
                return $listaFacturas;
            }
            return false;
        } catch(Exception $e){
            return false;
        }
    }
    
    public function delete(Factura $factura)
    {
        $n = $factura->getNumero();
        $q = "DELETE FROM facturas WHERE numero = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $n);
        return ($query->execute());
    }

    public function actualizarFactura(Factura $factura)
    {
        $n = $factura->getNombre();
        $a = $factura->getApellido();
        $d = $factura->getDetalle();
        $i = $factura->getImporte();
        $c = $factura->getCiudad();
        $ca = $factura->getCalle();
        $al = $factura->getAltura();

        $q = "UPDATE facturas SET nombre = ?, apellido = ?, detalle = ?, importe = ?, ciudad = ?, calle = ?, altura = ? WHERE numero = ?";
        
        $query = self::$conexion->prepare($q);
        $query->bind_param("sssissi", $n, $a, $d, $i, $c, $ca, $al);

        return $query->execute();
    }
}
    
