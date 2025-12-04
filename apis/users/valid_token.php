<?php
  
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  // Define o fuso horário padrão para o Brasil (São Paulo)
  date_default_timezone_set('America/Sao_Paulo');

  $token = $_GET['token'];

  $sql = "SELECT * FROM tokens_senha WHERE TOKEN = :token AND TEMPO_EXPIRA > :date_now;";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":token", $token, PDO::PARAM_STR);
  $stmt->bindValue(":date_now", date('Y-m-d H:i:s'), PDO::PARAM_STR);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
    
  if(!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Token Inválido!", "message" => "O Token expirou."]);
    exit();
  }

  echo json_encode(["status" => "success", "title" => "Token Válido!"]);