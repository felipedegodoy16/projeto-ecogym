<?php 
    require_once __DIR__ . '/User.php';

    class UserDAO {
        // Atributo
        private User $user;

        // Construtor da classe
        public function __construct($user) {
            $this->user = $user;
        }

        // Método para verificar se o email já foi cadastrado
        private function consultEmail() {
            $sql = "SELECT email FROM usuarios WHERE email = :email";

            $stmt = ConnectionFactory::getConnection()->prepare($sql);
            $stmt->bindValue(":email", $this->getUser()->getEmail(), PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount()) {
                return 1;
            }

            return 0;
        }

        // Método para fazer pré-cadastro
        public function insertPreRegister(){
            try {

                if($this->consultEmail()) {
                    return ["status" => "error", "title" => "Erro!", "message" => "O e-mail utilizado já está cadastrado em nosso sistema."];
                }

                // Query SQL
                $sql = "INSERT INTO usuarios (ID_USUARIO, NOME, SENHA, EMAIL, PERMISSAO, SITUACAO, ATIVO) VALUES 
                (DEFAULT, :nome, :senha, :email, 'U', 'M', 'A');";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":nome", $this->getUser()->getName(), PDO::PARAM_STR);
                $stmt->bindValue(":senha", $this->getUser()->getPassword(), PDO::PARAM_STR);
                $stmt->bindValue(":email", $this->getUser()->getEmail(), PDO::PARAM_STR);
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                // Executando a query no banco
                if($stmt->rowCount()) {
                    return ["status" => "success", "title" => "Sucesso!", "message" => "Usuário cadastrado com sucesso."];
                }

                return ["status" => "error", "title" => "Erro!", "message" => "Não foi possível cadastrar o usuário."];

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }
        
        // Método para fazer pré-cadastro
        public function insertFullRegister(){
            try {

                if($this->consultEmail()) {
                    return ["status" => "error", "title" => "Erro!", "message" => "O e-mail utilizado já está cadastrado em nosso sistema."];
                }

                // Query SQL
                $sql = "INSERT INTO usuarios (ID_USUARIO, NOME, EMAIL, GENERO, SENHA, CPF, TELEFONE, FK_CEP_ID, NUMERO_RESIDENCIAL, DATA_CADASTRO, PERMISSAO, SITUACAO, ATIVO) VALUES 
                (DEFAULT, :nome, :email, :genre, :senha, :cpf, :phone, :cep_id, :res_number, :date_cadastro, 'U', 'M', 'A');";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":nome", $this->getUser()->getName(), PDO::PARAM_STR);
                $stmt->bindValue(":email", $this->getUser()->getEmail(), PDO::PARAM_STR);
                $stmt->bindValue(":genre", $this->getUser()->getGenre(), PDO::PARAM_STR);
                $stmt->bindValue(":senha", $this->getUser()->getPassword(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $this->getUser()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":phone", $this->getUser()->getPhone(), PDO::PARAM_STR);
                $stmt->bindValue(":cep_id", $this->getUser()->getAddress()->getId(), PDO::PARAM_STR);
                $stmt->bindValue(":res_number", $this->getUser()->getAddress()->getNumber(), PDO::PARAM_STR);
                $stmt->bindValue(":date_cadastro", date('Y-m-d'), PDO::PARAM_STR);
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                // Executando a query no banco
                if($stmt->rowCount()) {
                    
                    $sql = "SELECT * FROM usuarios ORDER BY ID_USUARIO DESC LIMIT 1;";
                    $stmt = ConnectionFactory::getConnection()->prepare($sql);
                    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    return ["status" => "success", "title" => "Sucesso!", "message" => "Usuário cadastrado com sucesso.", "datas" => $datas];

                }

                return ["status" => "error", "title" => "Erro!", "message" => "Não foi possível cadastrar o usuário."];

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }

        // Método para fazer login do usuário
        public function login(){
            try {

                // Query
                $sql = "SELECT ID_USUARIO, NOME, EMAIL, GENERO, SENHA, PERMISSAO FROM usuarios WHERE EMAIL = :email LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":email", $this->getUser()->getEmail(), PDO::PARAM_STR);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $datas = $stmt->fetchAll();

                foreach($datas as $d){
                    $d['ID_USUARIO'];
                    $d['NOME'];
                    $d['EMAIL'];
                    $d['GENERO'];
                    $d['SENHA'];
                    $d['PERMISSAO'];
                }

                if($stmt->rowCount() > 0 && password_verify($this->getUser()->getPassword(), $d['SENHA'])){
                    
                    return ["id" => $d['ID_USUARIO'], "name" => $d['NOME'], "email" => $d['EMAIL'], "genre" => $d['GENERO'], "permissao" => $d['PERMISSAO']];

                } 
                
                return ["status" => "error", "title" => "Erro!", "message" => "O email e/ou senha estão incorretos."];

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Method Select Users
        public function selectUsers() {
            try {

                // Query
                $sql = "SELECT * FROM usuarios u LEFT JOIN cep ce ON u.FK_CEP_ID = ce.ID_CEP LEFT JOIN bairro b ON ce.FK_BAIRRO_ID = b.ID_BAIRRO LEFT JOIN cidade ci ON b.FK_CIDADE_ID = ci.ID_CIDADE LEFT JOIN estado e ON ci.FK_ESTADO_ID = e.ID_ESTADO WHERE u.ATIVO = 'A';";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if($stmt->rowCount() > 0){

                    return $datas;

                } 
                
                return ["status" => "error", "title" => "Erro!", "message" => "O email e/ou senha estão incorretos."];

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Method Alter User
        public function alter() {
            try {
                
                // Query
                $sql = "UPDATE usuarios SET NOME = :nome, EMAIL = :email, GENERO = :genre, CPF = :cpf, TELEFONE = :phone, FK_CEP_ID = :cep_id, NUMERO_RESIDENCIAL = :res_number WHERE ID_USUARIO = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);  

                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":nome", $this->getUser()->getName(), PDO::PARAM_STR);
                $stmt->bindValue(":email", $this->getUser()->getEmail(), PDO::PARAM_STR);
                $stmt->bindValue(":genre", $this->getUser()->getGenre(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $this->getUser()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":phone", $this->getUser()->getPhone(), PDO::PARAM_STR);
                $stmt->bindValue(":cep_id", $this->getUser()->getAddress()->getId(), PDO::PARAM_STR);
                $stmt->bindValue(":res_number", $this->getUser()->getAddress()->getNumber(), PDO::PARAM_STR);
                $stmt->bindValue(":id", $this->getUser()->getId(), PDO::PARAM_STR);
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                if($stmt->rowCount() > 0){

                    return ["status" => "success", "title" => "Sucesso!", "message" => "Usuário alterado com sucesso."];

                } 
                
                return ["status" => "error", "title" => "Erro!", "message" => "Não foi possível alterar o usuário."];

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Method Alter Own User
        public function alterOwn() {
            try {
                
                // Query
                $sql = "UPDATE usuarios SET NOME = :nome, EMAIL = :email, GENERO = :genre, CPF = :cpf, TELEFONE = :phone, DATA_NASCIMENTO = :date_nasc, FK_CEP_ID = :cep_id, NUMERO_RESIDENCIAL = :res_number WHERE ID_USUARIO = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);  

                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":nome", $this->getUser()->getName(), PDO::PARAM_STR);
                $stmt->bindValue(":email", $this->getUser()->getEmail(), PDO::PARAM_STR);
                $stmt->bindValue(":genre", $this->getUser()->getGenre(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $this->getUser()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":phone", $this->getUser()->getPhone(), PDO::PARAM_STR);
                $stmt->bindValue(":date_nasc", $this->getUser()->getDate(), PDO::PARAM_STR);
                $stmt->bindValue(":cep_id", $this->getUser()->getAddress()->getId(), PDO::PARAM_STR);
                $stmt->bindValue(":res_number", $this->getUser()->getAddress()->getNumber(), PDO::PARAM_STR);
                $stmt->bindValue(":id", $this->getUser()->getId(), PDO::PARAM_STR);
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                if($stmt->rowCount() > 0){

                    return ["status" => "success", "title" => "Sucesso!", "message" => "Usuário alterado com sucesso."];

                } 
                
                return ["status" => "error", "title" => "Erro!", "message" => "Não foi possível alterar o usuário."];

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Method Delete User
        public function delete() {
            try {

                // Query
                $sql = "UPDATE usuarios SET ATIVO = 'I' WHERE ID_USUARIO = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);

                $stmt->bindValue(":id", $this->getUser()->getId(), PDO::PARAM_INT);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                if($stmt->rowCount()){
                    return ["status" => "success", "title" => "Excluído!", "message" => "O usuário foi excluído com sucesso."];
                }
                
                return ["status" => "error", "title" => "Error!", "message" => "O usuário não pôde ser excluído."];

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Getters e Setters
        public function getUser() {
            return $this->user;
        }

        public function setUser($user) {
            $this->user = $user;
        }
    }