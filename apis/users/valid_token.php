<?php
  
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  // Define o fuso horário padrão para o Brasil (São Paulo)
  date_default_timezone_set('America/Sao_Paulo');

  $token = $_GET['token'];

  echo json_encode(["status" => $token]);
  exit();

  $sql = "SELECT * FROM tokens_senha WHERE TOKEN = :token AND TEMPO_EXPIRA > :date_now;";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":token", $token, PDO::PARAM_STR);
  $stmt->bindValue(":date_now", date('Y-m-d H:i:s'), PDO::PARAM_STR);
  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if(!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Token Inválido!", "message" => "O Token expirou."]);

    sleep(3);

    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] . '/projeto-ecogym/public/login.php');

    exit();
  }