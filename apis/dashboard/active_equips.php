<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Selecting All Equips
  $sql = "SELECT COUNT(*) FROM equipamento;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $total_equips = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
  
  // Selecting Active Equips
  $sql = "SELECT COUNT(*) FROM equipamento WHERE ATIVO = 'A';";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $active_equips = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];

  if($stmt->rowCount()) {
    echo json_encode(["total_equips" => $total_equips, "active_equips" => $active_equips]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);