<?php

class customer
{
	private $id;
    private $title;
	private $name;
	private $surname;
	private $address;
	private $city;
	private $postalCode;
	private $phoneNumber;
	private $emailAddress;
	private $password;

	public function __construct()
    {
        
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setTitle($title) {
    	$this->title = $title;
    }

    public function setName($name){
    	$this->name = $name;
    }

    public function setSurname($surname){
    	$this->surname = $surname;
    }

    public function setAddress($address){
		$this->address = $address;
    }

    public function setCity($city){
    	$this->city = $city;
    }

    public function setPostalCode($postalCode){
    	$this->postalCode = $postalCode;
    }
	
	public function setPhoneNumber($phoneNumber){
    	$this->phoneNumber = $phoneNumber;
    }
	
	public function setEmailAddress($emailAddress){
    	$this->emailAddress = $emailAddress;
    }
	
	public function setPassword($password){
    	$this->password = $password;
    }

    public function getId() {
        return $this->id;
    }
    public function getTitle() {
    	return $this->title;
    }

    public function getName(){
    	return $this->name;
    }

    public function getSurname(){
    	return $this->surname;
    }

    public function getAddress(){
    	return $this->address;
    }

    public function getCity(){
    	return $this->city;
    }

    public function getPostalCode(){
    	return $this->postalCode;
    }
	
	public function getPhoneNumber(){
    	return $this->phoneNumber;
    }
	
	public function getEmailAddress(){
    	return $this->emailAddress;
    }
	
	public function getPassword(){
    	return $this->password;
    }
}

?>