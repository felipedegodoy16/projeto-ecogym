<?php 

  session_start();
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Selecting All Equips
  // $sql = "SELECT DATE_FORMAT(DATA_MOVIMENTO, '%Y-%m-%d') AS FULL_DATA, SUM(CALORIA_GASTA) AS CALORIA FROM movimento WHERE DATA_MOVIMENTO >= DATEADD(day, -7, GETDATE()) GROUP BY FULL_DATA;";
  $sql = "SELECT DATE_FORMAT(DATA_MOVIMENTO, '%Y-%m-%W') AS FULL_DATA, SUM(CALORIA_GASTA) AS CALORIA FROM movimento WHERE FK_USUARIO_ID = :id AND DATA_MOVIMENTO >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY FULL_DATA ORDER BY FULL_DATA DESC;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id", $_SESSION['id'], PDO::PARAM_INT);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal_days = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $days_practiced = [];

  foreach($kcal_days as $day) {
    if(substr($day['FULL_DATA'], 8) === 'Monday') {
      $day['DIA'] = 'Seg';
    } else if(substr($day['FULL_DATA'], 8) === 'Tuesday') {
      $day['DIA'] = 'Ter';
    } else if(substr($day['FULL_DATA'], 8) === 'Wednesday') {
      $day['DIA'] = 'Qua';
    } else if(substr($day['FULL_DATA'], 8) === 'Thursday') {
      $day['DIA'] = 'Qui';
    } else if(substr($day['FULL_DATA'], 8) === 'Friday') {
      $day['DIA'] = 'Fri';
    } else if(substr($day['FULL_DATA'], 8) === 'Saturday') {
      $day['DIA'] = 'Sáb';
    } else {
      $day['DIA'] = 'Dom';
    }
    
    $day['KWH'] = $day['CALORIA'] * 0.001163;
    
    array_push($days_practiced, $day);
  }

  if($stmt->rowCount()) {
    echo json_encode($days_practiced);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);