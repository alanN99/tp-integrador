<?php
require_once '.env.php';
require_once 'clases/Usuario.php';
require_once 'clases/Factura.php';

class RepositorioFactura
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   
                $credenciales['servidor'],
                $credenciales['usuario'],
                $credenciales['clave'],
                $credenciales['base_de_datos']
            );

            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }

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
}
    
