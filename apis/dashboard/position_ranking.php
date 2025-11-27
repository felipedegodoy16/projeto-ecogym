<?php 

  session_start();
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Kcal Spent Current Month
  $formatted_date = date("Y") . '-' . date("m") . '-01';

  // Selecting All Equips
  $sql = "SELECT ROW_NUMBER() OVER (ORDER BY SUM(m.CALORIA_GASTA) DESC) AS POSICAO, SUM(m.CALORIA_GASTA) AS CALORIA, u.NOME, u.CPF, u.ID_USUARIO FROM movimento m INNER JOIN usuarios u ON m.FK_USUARIO_ID = u.ID_USUARIO WHERE DATA_MOVIMENTO >= :formatted_date GROUP BY FK_USUARIO_ID ORDER BY SUM(m.CALORIA_GASTA) DESC;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":formatted_date", $formatted_date, PDO::PARAM_STR);
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $ranking_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($ranking_users) {
    foreach($ranking_users as $u) {
      if($u['ID_USUARIO'] == $_SESSION['id']) {
        echo json_encode($u);
        exit();
      }
    }
  }

  echo json_encode(["status" => "error", "title" => "Você ainda não treinou!", "message" => "Nenhum treino foi realizado por você esse mês."]);