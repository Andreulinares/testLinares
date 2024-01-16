<?php

class Reseña{
    private $reseña_id;
    private $id_cliente;
    private $puntuacion;
    private $comentario;
    private $fecha_creacion;

    public function __construct($reseña_id, $id_cliente, $puntuacion, $comentario, $fecha_creacion)
    {
        $this->reseña_id = $reseña_id;
        $this->id_cliente = $id_cliente;
        $this->puntuacion = $puntuacion;
        $this->comentario = $comentario;
        $this->fecha_creacion = $fecha_creacion;
    }

    /**
     * Get the value of reseña_id
     */ 
    public function getReseña_id()
    {
        return $this->reseña_id;
    }

    /**
     * Set the value of reseña_id
     *
     * @return  self
     */ 
    public function setReseña_id($reseña_id)
    {
        $this->reseña_id = $reseña_id;

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
     * Get the value of puntuacion
     */ 
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    /**
     * Set the value of puntuacion
     *
     * @return  self
     */ 
    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    /**
     * Get the value of comentario
     */ 
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     *
     * @return  self
     */ 
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get the value of fecha_creacion
     */ 
    public function getFecha_creacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * Set the value of fecha_creacion
     *
     * @return  self
     */ 
    public function setFecha_creacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }
}
?>