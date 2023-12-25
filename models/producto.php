<?php
class Producto
{
    private $db;
    public function __construct(private int $id, private string $nombre, private int $precio, private string $descripcion)
    {
        $this->db = new ConexionDB;
    }

    // Métodos para acceder y modificar atributos
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function obtenerPrecioConImpuestos($impuesto)
    {
        $precioConImpuestos = $this->precio * (1 + ($impuesto / 100));
        return $precioConImpuestos;
    }
}
