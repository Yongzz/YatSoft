<?php

class item
{
	private $id;
	private $name;
	private $price;
	private $quantity;
	private $image;
	private $description;

	public function __construct()
    {
        
    }

    public function setId($id) {
    	$this->id = $id;
    }

    public function setName($name){
    	$this->name = $name;
    }

    public function setPrice($price){
    	$this->price = $price;
    }

    public function setQuantity($quantity){
    	$this->quantity = $quantity;
    }

    public function setImage($image){
    	$this->image = $image;
    }

    public function setDescription($description){
    	$this->description = $description;
    }

    
    public function getId() {
    	return $this->id;
    }

    public function getName(){
    	return $this->name;
    }

    public function getPrice(){
    	return $this->price;
    }

    public function getQuantity(){
    	return $this->quantity;
    }

    public function getImage(){
    	return $this->image;
    }

    public function getDescription(){
    	return $this->description;
    }


}

?>