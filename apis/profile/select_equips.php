<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $sql = "SELECT ID_EQUIPAMENTO, NOME FROM equipamento WHERE ATIVO = 'A';";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($stmt->rowCount()){
    echo json_encode($datas);
    exit();
  }
    
  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar od equipamentos."]);