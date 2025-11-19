<?php 
    require_once __DIR__ . '/ConnectionFactory.php';

    class Address {
        // Atributos
        private int $id;
        private string $street, $cep, $city, $state, $neighborhood, $number;

        // Método construtor
        public function __construct(){
            
        }

        // Getters e Setters
        public function getId(){
            return $this->id;
        }

        public function getCep(){
            return $this->cep;
        }

        public function getStreet(){
            return $this->street;
        }

        public function getCity(){
            return $this->city;
        }

        public function getState(){
            return $this->state;
        }

        public function getNeighborhood(){
            return $this->neighborhood;
        }
        
        public function getNumber(){
            return $this->number;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }

        public function setStreet($street){
            $this->street = $street;
        }

        public function setCity($city){
            $this->city = $city;
        }

        public function setState($state){
            $this->state = $state;
        }

        public function setNeighborhood($neighborhood){
            $this->neighborhood = $neighborhood;
        }
        
        public function setNumber($number){
            $this->number = $number;
        }
    }