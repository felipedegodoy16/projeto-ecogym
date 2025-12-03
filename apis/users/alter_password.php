<?php
  
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  $datas = json_decode(file_get_contents("php://input"), true);

  $sql = "SELECT * FROM tokens_senha WHERE TOKEN = :token AND TEMPO_EXPIRA > NOW();";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":token", $token, PDO::PARAM_STR);
  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if(!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Token Inválido!", "message" => "O Token expirou."]);

    sleep(3);

    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] . '/projeto-ecogym/public/login.php');

    exit();
  }