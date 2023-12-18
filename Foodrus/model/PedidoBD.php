<?php

class PedidoBD{
    private $pedido_id;
    private $id_cliente;
    private $cantidad;
    private $estado;
    private $fecha_pedido;

    public function __construct($pedido_id, $id_cliente, $cantidad, $estado, $fecha_pedido)
    {
        $this->pedido_id = $pedido_id;
        $this->id_cliente = $id_cliente;
        $this->cantidad = $cantidad;
        $this->estado = $estado;
        $this->fecha_pedido = $fecha_pedido;
    }

    /**
     * Get the value of pedido_id
     */ 
    public function getPedido_id()
    {
        return $this->pedido_id;
    }

    /**
     * Set the value of pedido_id
     *
     * @return  self
     */ 
    public function setPedido_id($pedido_id)
    {
        $this->pedido_id = $pedido_id;

        return $this;
    }

    /**
     * Get the value of id_cliente
     */ 
    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    /**
     * Set the value of id_cliente
     *
     * @return  self
     */ 
    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of fecha_pedido
     */ 
    public function getFecha_pedido()
    {
        return $this->fecha_pedido;
    }

    /**
     * Set the value of fecha_pedido
     *
     * @return  self
     */ 
    public function setFecha_pedido($fecha_pedido)
    {
        $this->fecha_pedido = $fecha_pedido;

        return $this;
    }
}