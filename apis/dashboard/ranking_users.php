<?php 

  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Selecting All Equips
  $sql = "SELECT SUM(m.CALORIA_GASTA) AS CALORIA, u.NOME, u.CPF, u.ID_USUARIO FROM movimento m INNER JOIN usuarios u ON m.FK_USUARIO_ID = u.ID_USUARIO GROUP BY FK_USUARIO_ID ORDER BY SUM(m.CALORIA_GASTA) DESC LIMIT 5;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $ranking_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($stmt->rowCount()) {
    echo json_encode($ranking_users);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);