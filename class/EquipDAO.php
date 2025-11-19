<?php 
    require_once __DIR__ . '/Equip.php';

    class EquipDAO {
        // Atributo
        private Equip $equip;

        // Construtor da classe
        public function __construct($equip) {
            $this->equip = $equip;
        }

        // Method Inser Equip
        public function insert(){
            try {
                // Query SQL
                $sql = "INSERT INTO equipamento (ID_EQUIPAMENTO, NOME, KCAL_HORA, FK_ACADEMIA_ID, SITUACAO, ATIVO) VALUES 
                (DEFAULT, :nome, :kcal, 1, :situation, 'A');";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":nome", $this->getEquip()->getName(), PDO::PARAM_STR);
                $stmt->bindValue(":kcal", $this->getEquip()->getKcal(), PDO::PARAM_STR);
                $stmt->bindValue(":situation", $this->getEquip()->getSituation(), PDO::PARAM_STR);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                
                // Executando a query no banco
                if($stmt->rowCount()) {
                    $sql = "SELECT * FROM equipamento ORDER BY ID_EQUIPAMENTO DESC LIMIT 1;";
                    $stmt = ConnectionFactory::getConnection()->prepare($sql);
                    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    return ["status" => "success", "title" => "Sucesso!", "message" => "Equipamento cadastrado com sucesso.", "datas" => $datas];
                }

                return ["status" => "error", "title" => "Erro!", "message" => "Não foi possível cadastrar o equipamento."];

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }

        // Method Select Equips
        public function select() {
            try {

                // Query
                $sql = "SELECT * FROM equipamento WHERE ATIVO = 'A';";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if($stmt->rowCount()){
                    return $datas;
                }
                
                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Method Delete Equip
        public function delete() {
            try {

                // Query
                $sql = "UPDATE equipamento SET ATIVO = 'I' WHERE ID_EQUIPAMENTO = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);

                $stmt->bindValue(":id", $this->getEquip()->getId(), PDO::PARAM_INT);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                if($stmt->rowCount()){
                    return ["status" => "success", "title" => "Excluído!", "message" => "O equipamento foi excluído com sucesso."];
                }
                
                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Method Alter Equip
        public function alter(){
            try {
                // Query SQL
                $sql = "UPDATE equipamento SET NOME = :nome, KCAL_HORA = :kcal, SITUACAO = :situation WHERE ID_EQUIPAMENTO = :id;";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConnection()->prepare($sql);
                $stmt->bindValue(":nome", $this->getEquip()->getName(), PDO::PARAM_STR);
                $stmt->bindValue(":kcal", $this->getEquip()->getKcal(), PDO::PARAM_STR);
                $stmt->bindValue(":situation", $this->getEquip()->getSituation(), PDO::PARAM_STR);
                $stmt->bindValue(":id", $this->getEquip()->getId(), PDO::PARAM_INT);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                
                // Executando a query no banco
                if($stmt->rowCount()) {
                    return ["status" => "success", "title" => "Sucesso!", "message" => "Equipamento alterado com sucesso."];
                }

                return ["status" => "error", "title" => "Erro!", "message" => "Não foi possível alterar o equipamento."];

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }

        // Getters e Setters
        public function getEquip() {
            return $this->equip;
        }

        public function setEquip($equip) {
            $this->equip = $equip;
        }
    }