<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Select All Active Users
  $sql = "SELECT COUNT(*) FROM usuarios WHERE ATIVO = 'A';";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $total_users = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];

  // Select Active Users Current Month
  $formatted_data = date("Y") . '-' . date("m") . '-01';
  
  $sql = "SELECT COUNT(*) FROM usuarios WHERE ATIVO = 'A' AND DATA_CADASTRO >= :formatted_data;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":formatted_data", $formatted_data, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $total_month = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];

  if($stmt->rowCount()) {
    echo json_encode(["total_users" => $total_users, "total_month" => $total_month]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);