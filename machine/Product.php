<?php

//On créé la classe "Product"
class Product
{
    protected $id;
    protected $price;
    protected $title;
    protected $shippingCost;

    public function __construct($id, $price, $title, $shippingCost)
    {
        $this->id = $id;
        $this->price = $price;
        $this->title = $title;
        $this->shippingCost = $shippingCost;
    }

    public function buy()
    {
        //Implémentation de l'achat du produit
    }

    public function ship()
    {

    }
}

//On créé la classe "DigitalProduct"
class DigitalProduct extends Product {

    public function __construct($id, $price, $title, $shippingCost) {
        parent::__construct($id, $price, $title, $shippingCost);
    }

    public function ship() {

        //Implémentation pour l'envoi d'un produit numérique
    }
}
