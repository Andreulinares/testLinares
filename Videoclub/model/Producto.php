<?php

abstract class Producto{

    const precioPizza = 0;
    const precioBebida = 0;

    protected $id;
    protected $name;
    protected $descripcion;

    public function __construct($id, $name, $descripcion)
    {
        $this->id = $id;
        $this->name = $name;
        $this->descripcion = $descripcion;
    }

    /**
     * Get the value of tipo
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public abstract function calculaPrecioTotal($numProducto);
    public abstract function devuelvePrecioProducto();
}

?>