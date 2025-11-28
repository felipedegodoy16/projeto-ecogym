<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $formatted_date = date("Y") . '-' . date("m") . '-01';

  // Selecting All Equips
  $sql = "SELECT SUM(CALORIA_GASTA) AS CALORIA FROM movimento WHERE DATA_MOVIMENTO >= :formatted_date;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":formatted_date", $formatted_date, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal_month = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['CALORIA'];

  $month_kwh = $kcal_month * 0.001163;

  if($stmt->rowCount()) {
    echo json_encode($month_kwh);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);