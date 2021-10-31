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
        $nombre = $factura->getNombre();
        $apellido = $factura->getApellido();
        $detalle = $factura->getDetalle();
        $importe = $factura->getImporte();
        $ciudad = $factura->getCiudad();
        $calle = $factura->getCalle();
        $altura = $factura->getAltura();
        $id_usuario =$factura->getIdUsuario();

        $q = "INSERT INTO facturas (nombre, apellido, detalle, importe, ciudad, calle, altura, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        try{
            $query = self::$conexion->prepare($q);
    
            $query->bind_param($nombre, $apellido, $detalle, $ciudad, $calle, $importe, $altura, $id_usuario);
    
            if ($query->execute()) {
                return self::$conexion->insert_id;
            } else {
                return false;
            }
        } catch (Exception $e){
            return false;
        }
    }
   
}
    
