<?php
    require_once __DIR__ . '/ConnectionFactory.php';
    require_once __DIR__ . '/Address.php';
    // require_once 'Academia.php';
    // require_once 'Plano.php';
    
    class User {
        // Atributos
        private string $name, $cpf, $phone, $permission, $active, $password, $genre, $email;
        private int $id;
        private Address $address;
        // private Academia $academia;
        // private Plano $plano;

        // Método construtor
        public function __construct(){
            
        }

        // Getters e Setters
        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function getPhone(){
            return $this->phone;
        }

        public function getPermission(){
            return $this->permission;
        }
        
        public function getActive(){
            return $this->active;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getGenre(){
            return $this->genre;
        }
        
        public function getEmail(){
            return $this->email;
        }

        public function getAddress(){
            return $this->address;
        }

        // public function getAcademia(){
        //     return $this->academia;
        // }

        // public function getPlano(){
        //     return $this->plano;
        // }
        
        public function setId($id){
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;
        }

        public function setPhone($phone){
            $this->phone = $phone;
        }

        public function setPermission($permission){
            $this->permission = $permission;
        }

        public function setActive($active){
            $this->active = $active;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setGenre($genre){
            $this->genre = $genre;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setAddress($address){
            $this->address = $address;
        }

        // public function setAcademia($academia){
        //     $this->academia = $academia;
        // }
        
        // public function setPlano($plano){
        //     $this->plano = $plano;
        // }
    }