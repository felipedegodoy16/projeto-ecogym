<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Selecting All Equips
  $sql = "SELECT DATE_FORMAT(DATA_MOVIMENTO, '%Y-%M') AS ANO_MES, SUM(CALORIA_GASTA) AS CALORIA FROM movimento GROUP BY ANO_MES ORDER BY ANO_MES;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal_month = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $month_datas = [];

  $currentYear = date('Y');

  foreach($kcal_month as $month) {
    if(str_contains($month["ANO_MES"], $currentYear)) {
      $month["KWH"] = $month["CALORIA"] * 0.001163;
      array_push($month_datas, $month);
    }
  }

  if($stmt->rowCount()) {
    echo json_encode($month_datas);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);