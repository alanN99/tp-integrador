<?php

require_once 'Usuario.php';

class Factura
{
    protected $usuario;
    protected $numero;

    public function __construct($usuario, $nombre, $apellido, $detalle, $importe, $ciudad, $calle, $altura, $numero = null)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->detalle = $detalle;
        $this->importe = $importe;
        $this->ciudad = $ciudad;
        $this->calle = $calle;
        $this->altura = $altura;
        $this->numero = $numero;
    }

    public function getIdUsuario()
    {
        return $this->usuario->getId();
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getDetalle()
    {
        return $this->detalle;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($n)
    {
        $this->numero = $n;
    }

    public function editar($n,$a,$d,$i,$c,$ca,$al)
    {
        if($this->nombre <> $n || $this->apellido <> $a || $this->detalle <> $d || $this->importe <> $i || $this->ciudad <> $c || $this->calle <> $ca || $this->altura <> $al) {
            $this->nombre = $n;
            $this->apellido = $a;
            $this->detalle = $d;
            $this->importe = $i;
            $this->ciudad = $c;
            $this->calle = $ca;
            $this->altura = $al;
            return true;
        } else {
            return false;
        }
    }

}