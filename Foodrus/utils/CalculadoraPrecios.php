<?php
Class CalculadoraPrecios{

    public static function calcularPrecioPedido($pedidos){
        $precioTotal = 0;

        foreach ($pedidos as $pedido){
            $precioTotal += $pedido->getPrecio();
        }

        return $precioTotal;
    }
}
?>