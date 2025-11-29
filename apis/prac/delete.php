<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: DELETE");
  header("Access-Control-Allow-Headers: Content-Type");

  parse_str(file_get_contents("php://input"), $data);

  $id = intval(trim($data['id']));

  $sql = "UPDATE treino SET ATIVO = 'I' WHERE ID_TREINO = :id;";

  // Conectando ao banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id", $id, PDO::PARAM_INT);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if($stmt->rowCount()){
    echo json_encode(["status" => "success", "title" => "Excluído!", "message" => "O treino foi excluído com sucesso."]);
    exit();
  }
  
  echo json_encode(["status" => "error", "title" => "Error!", "message" => "Não foi possível excluir treino."]);
    
  