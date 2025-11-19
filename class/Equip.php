<?php
    require_once __DIR__ . '/ConnectionFactory.php';
    // require_once 'Academia.php';
    
    class Equip {
        // Atributos
        private string $name, $active, $situation;
        private int $id;
        private float $kcal;
        // private Academia $academia;

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
        
        public function getKcal(){
            return $this->kcal;
        }

        public function getSituation(){
            return $this->situation;
        }
        
        public function getActive(){
            return $this->active;
        }

        // public function getAcademia(){
        //     return $this->academia;
        // }
        
        public function setId($id){
            $this->id = $id;
        }

        public function setName($name){
            $this->name = $name;
        }
        
        public function setKcal($kcal){
            $this->kcal = $kcal;
        }

        public function setSituation($situation){
            $this->situation = $situation;
        }

        public function setActive($active){
            $this->active = $active;
        }

        // public function setAcademia($academia){
        //     $this->academia = $academia;
        // }
    }