<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");
  
  $sql = "SELECT * FROM movimento m INNER JOIN equipamento e ON m.FK_EQUIPAMENTO_ID = e.ID_EQUIPAMENTO WHERE m.FK_USUARIO_ID = :id ORDER BY m.DATA_MOVIMENTO DESC LIMIT 10;";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id", $_SESSION['id'], PDO::PARAM_INT);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $movis = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($stmt->rowCount()){

    echo json_encode(["movis" => $movis]);
    exit();

  }
    
  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não há nenhum movimento."]);