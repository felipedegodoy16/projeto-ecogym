<?php
  
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $new_password = json_decode(file_get_contents("php://input"), true);
  $token = $_GET['token'];

  $sql = "SELECT * FROM tokens_senha WHERE TOKEN = :token AND TEMPO_EXPIRA > NOW();";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":token", $token, PDO::PARAM_STR);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  
  if(!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Token Inválido!", "message" => "O Token expirou.", "exit" => true]);
    exit();
  }

  $sql = "UPDATE usuarios SET SENHA = :new_password WHERE EMAIL = :email;";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":new_password", password_hash($new_password['alter-password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
  $stmt->bindValue(":email", $datas['EMAIL'], PDO::PARAM_STR);

  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if($stmt->rowCount()) {
    echo json_encode(["status" => "success", "title" => "Senha alterada!", "message" => "Sua senha foi alterada com sucesso.", "exit" => true]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível alterar a senha.", "exit" => false]);