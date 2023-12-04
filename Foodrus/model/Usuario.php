<?php

class Usuario{
    private $cliente_id;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $email;
    private $password;

    public function __construct($cliente_id, $nombre, $apellidos, $telefono, $email, $password)
    {
        $this->cliente_id = $cliente_id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->password = $password;
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
}
?>