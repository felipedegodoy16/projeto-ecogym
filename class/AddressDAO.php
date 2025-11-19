<?php 
    require_once __DIR__ . '/Address.php';

    class AddressDAO {
        // Atributo
        private Address $address;

        // Construtor da classe
        public function __construct($address) {
            $this->address = $address;
        }

        // Método para verificação de uf
        public function verifyUf() {
            try {

                // Query
                $sql = "SELECT ID_ESTADO FROM estado WHERE
                UF = :uf LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":uf", $this->getAddress()->getState(), PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $data = $stmt->fetchAll();
                
                foreach($data as $d){
                    $d['ID_ESTADO'];
                }

                // Verificando existência do endereço no banco
                if($stmt->rowCount()){
                    return $d['ID_ESTADO'];
                }

                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para inserir uf
        public function insertUf() {

            $id_uf = $this->verifyUf();

            if(!$id_uf) {
                // Query
                $sql = "INSERT INTO estado VALUES
                (DEFAULT, :uf);";

                // Conectando ao banco e preparando query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":uf", $this->getAddress()->getState(), PDO::PARAM_STR);
                
                // Executando query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                $id_uf = $this->verifyUf();
            }

            return $id_uf;
        }

        // Método para verificação de uf
        public function verifyCity() {
            try {

                // Query
                $sql = "SELECT ID_CIDADE FROM cidade WHERE
                CIDADE = :city LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":city", $this->getAddress()->getCity(), PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $data = $stmt->fetchAll();
                
                foreach($data as $d){
                    $d['ID_CIDADE'];
                }

                // Verificando existência do endereço no banco
                if($stmt->rowCount()){
                    return $d['ID_CIDADE'];
                }

                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para inserir uf
        public function insertCity() {

            $id_city = $this->verifyCity();

            if(!$id_city) {
                
                $id_uf = $this->insertUf();
                
                // Query
                $sql = "INSERT INTO cidade VALUES
                (DEFAULT, :city, :id_uf);";

                // Conectando ao banco e preparando query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":city", $this->getAddress()->getCity(), PDO::PARAM_STR);
                $stmt->bindValue(":id_uf", $id_uf, PDO::PARAM_INT);
                
                // Executando query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                $id_city = $this->verifyCity();
            }

            return $id_city;
        }

        // Método para verificação de uf
        public function verifyNeighborhood() {
            try {

                // Query
                $sql = "SELECT ID_BAIRRO FROM bairro WHERE
                BAIRRO = :neigh LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":neigh", $this->getAddress()->getNeighborhood(), PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $data = $stmt->fetchAll();
                
                foreach($data as $d){
                    $d['ID_BAIRRO'];
                }

                // Verificando existência do endereço no banco
                if($stmt->rowCount()){
                    return $d['ID_BAIRRO'];
                }

                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para inserir uf
        public function insertNeighborhood() {

            $id_neigh = $this->verifyNeighborhood();

            if(!$id_neigh) {
                
                $id_city = $this->insertCity();
                
                // Query
                $sql = "INSERT INTO bairro VALUES
                (DEFAULT, :neigh, :id_city);";

                // Conectando ao banco e preparando query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":neigh", $this->getAddress()->getNeighborhood(), PDO::PARAM_STR);
                $stmt->bindValue(":id_city", $id_city, PDO::PARAM_INT);
                
                // Executando query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                $id_neigh = $this->verifyNeighborhood();
            }

            return $id_neigh;
        }

        // Método para verificação de cep
        public function verifyCep() {
            try {

                // Query
                $sql = "SELECT ID_CEP FROM cep WHERE
                CEP = :cep LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":cep", $this->getAddress()->getCep(), PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $data = $stmt->fetchAll();
                
                foreach($data as $d){
                    $d['ID_CEP'];
                }

                // Verificando existência do endereço no banco
                if($stmt->rowCount()){
                    $this->getAddress()->setId($d['ID_CEP']);
                    return 1;
                }

                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para inserção do endereço no Banco
        public function insert(){
            try {
                $return = $this->verifyCep();

                if(!$return) {
                    
                    $id_neigh = $this->insertNeighborhood();
                    
                    // Query
                    $sql = "INSERT INTO cep VALUES
                    (DEFAULT, :cep, :street, :id_neigh);";

                    // Conectando ao banco e preparando query
                    $stmt = ConnectionFactory::getConnection()->prepare($sql);
                    $stmt->bindValue(":cep", $this->getAddress()->getCep(), PDO::PARAM_STR);
                    $stmt->bindValue(":street", $this->getAddress()->getStreet(), PDO::PARAM_STR);
                    $stmt->bindValue(":id_neigh", $id_neigh, PDO::PARAM_INT);
                    
                    // Executando query no banco
                    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                    $return = $this->verifyCep();
                }

                return $return;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Getters e Setters
        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
        }
    }