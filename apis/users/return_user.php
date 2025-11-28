<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  // Selecting All Equips
  $sql = "SELECT * FROM usuarios u LEFT JOIN cep ce ON u.FK_CEP_ID = ce.ID_CEP LEFT JOIN bairro b ON ce.FK_BAIRRO_ID = b.ID_BAIRRO LEFT JOIN cidade ci ON b.FK_CIDADE_ID = ci.ID_CIDADE LEFT JOIN estado e ON ci.FK_ESTADO_ID = e.ID_ESTADO WHERE u.ID_USUARIO = :id;";

  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id", $_SESSION['id'], PDO::PARAM_INT);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
  $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($stmt->rowCount()) {
    echo json_encode($user);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível buscar os dados."]);