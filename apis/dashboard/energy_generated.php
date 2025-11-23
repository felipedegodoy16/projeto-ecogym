<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $sql = "SELECT SUM(CALORIA_GASTA) FROM movimento;";

  // Conectando ao banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $kwh = $kcal[0]['SUM(CALORIA_GASTA)'] * 0.001163;

  if($stmt->rowCount()) {
    echo json_encode($kwh);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);