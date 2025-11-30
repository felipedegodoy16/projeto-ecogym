<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");
  
  $sql = "SELECT * FROM calculo_fisico WHERE FK_ID_USUARIO = :id ORDER BY DATA_CALCULO DESC;";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id", $_SESSION['id'], PDO::PARAM_INT);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $calcs = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($stmt->rowCount()){

    echo json_encode(["calcs" => $calcs]);
    exit();

  }
    
  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não há nenhum cálculo."]);