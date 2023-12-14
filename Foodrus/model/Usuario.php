<?php

class Usuario{
    private $cliente_id;
    private $email;
    private $nombre;
    private $apellidos;
    private $password;
    private $telefono;
    private $rol;

    public function __construct($cliente_id, $email, $nombre, $apellido, $password, $telefono, $rol)
    {
        $this->cliente_id = $cliente_id;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellidos = $apellido;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->rol = $rol;
    }

    public function getCliente_id(){
        return $this->cliente_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol(){
        return $this->rol;
    }
}
?>