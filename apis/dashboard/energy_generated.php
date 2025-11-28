<?php 

  require_once __DIR__ . '/../files/logged_admin.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Total Kcal Spent
  $sql = "SELECT SUM(CALORIA_GASTA) FROM movimento;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['SUM(CALORIA_GASTA)'];

  $total_kwh = $kcal * 0.001163;

  // Kcal Spent Current Month
  $formatted_date = date("Y") . '-' . date("m") . '-01';
  
  $sql = "SELECT SUM(CALORIA_GASTA) FROM movimento WHERE DATA_MOVIMENTO >= :formatted_date;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":formatted_date", $formatted_date, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['SUM(CALORIA_GASTA)'];

  $month_kwh = $kcal * 0.001163;

  if($stmt->rowCount()) {
    echo json_encode(["total_kwh" => $total_kwh, "month_kwh" => $month_kwh]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);