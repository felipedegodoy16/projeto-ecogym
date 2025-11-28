<?php 

  require_once __DIR__ . '/../files/logged_admin.php';
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
  $formatted_date = date("Y") . '-' . date("m") . '-01';
  
  $sql = "SELECT COUNT(*) FROM usuarios WHERE ATIVO = 'A' AND DATA_CADASTRO >= :formatted_date;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":formatted_date", $formatted_date, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $new_users = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];

  if($stmt->rowCount()) {
    echo json_encode(["total_users" => $total_users, "new_users" => $new_users]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);