<?php

abstract class Producto{

    protected $producto_id;
    protected $almacen_id;
    protected $nombre_producto;
    protected $descripcion;
    protected $categoria;
    protected $precio;
    protected $imagen;

    public function __construct($producto_id, $almacen_id, $nombre_producto, $descripcion, $precio, $categoria, $imagen)
    {
        $this->producto_id = $producto_id;
        $this->almacen_id = $almacen_id;
        $this->nombre_producto = $nombre_producto;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public abstract function calculaPrecioTotal($numProducto);
    public abstract function devuelvePrecioProducto();

    /**
     * Get the value of producto_id
     */ 
    public function getProducto_id()
    {
        return $this->producto_id;
    }

    /**
     * Set the value of producto_id
     *
     * @return  self
     */ 
    public function setProducto_id($producto_id)
    {
        $this->producto_id = $producto_id;

        return $this;
    }

    /**
     * Get the value of nombre_producto
     */ 
    public function getNombre_producto()
    {
        return $this->nombre_producto;
    }

    /**
     * Set the value of nombre_producto
     *
     * @return  self
     */ 
    public function setNombre_producto($nombre_producto)
    {
        $this->nombre_producto = $nombre_producto;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of almacen
     */ 
    public function getAlmacen()
    {
        return $this->almacen_id;
    }

    /**
     * Set the value of almacen
     *
     * @return  self
     */ 
    public function setAlmacen($almacen_id)
    {
        $this->almacen_id = $almacen_id;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        $rutaCompleta = '../uploads/' . $this->imagen;
        return $rutaCompleta;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }
}

?>