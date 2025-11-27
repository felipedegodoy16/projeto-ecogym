<?php 

  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Kcal Spent Current Month
  $formatted_date = date("Y") . '-' . date("m") . '-01';

  // Selecting All Equips
  $sql = "SELECT SUM(m.CALORIA_GASTA) AS CALORIA, u.NOME, u.CPF, u.ID_USUARIO FROM movimento m INNER JOIN usuarios u ON m.FK_USUARIO_ID = u.ID_USUARIO WHERE DATA_MOVIMENTO >= :formatted_date GROUP BY FK_USUARIO_ID ORDER BY SUM(m.CALORIA_GASTA) DESC LIMIT 5;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":formatted_date", $formatted_date, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $ranking_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($stmt->rowCount()) {
    echo json_encode($ranking_users);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);