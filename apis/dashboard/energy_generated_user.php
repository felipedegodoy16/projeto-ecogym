<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Kcal Spent Current Month
  $formatted_date = date("Y") . '-' . date("m") . '-01';

  // Total Kcal Spent
  $sql = "SELECT SUM(CALORIA_GASTA) FROM movimento WHERE FK_USUARIO_ID = :id AND DATA_MOVIMENTO >= :formatted_date;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);
  
  $stmt->bindValue(":id", $_SESSION['id'], PDO::PARAM_INT);
  $stmt->bindValue(":formatted_date", $formatted_date, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $kcal = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['SUM(CALORIA_GASTA)'];

  $month_kwh = $kcal * 0.001163;

  if($stmt->rowCount()) {
    echo json_encode(["user_kwh_month" => $month_kwh]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Você ainda não treinou!", "message" => "Nenhum treino foi realizado por você esse mês ainda."]);