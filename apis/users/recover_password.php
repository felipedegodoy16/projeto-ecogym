<?php 

  require_once __DIR__ . '/../PHPMailer/php_mailer_config.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  // Define o fuso horário padrão para o Brasil (São Paulo)
  date_default_timezone_set('America/Sao_Paulo');

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  parse_str(file_get_contents("php://input"), $data);

  $email = $data['email'];
  $token = bin2hex(random_bytes(50));
  $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

  $sql = "SELECT * FROM usuarios WHERE EMAIL = :email;";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":email", $email, PDO::PARAM_STR);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if (!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Erro!", "message" => "O email digitado não foi encontrado em nossos registros."]);
    exit();
  }

  $sql = "INSERT INTO tokens_senha (EMAIL, TOKEN, TEMPO_EXPIRA) VALUES (:email, :token, :expires);";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":email", $email, PDO::PARAM_STR);
  $stmt->bindValue(":token", $token, PDO::PARAM_STR);
  $stmt->bindValue(":expires", $expires, PDO::PARAM_STR);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));
    
  if(!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Ocorreu um erro inesperado."]);
    exit();
  }

  $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
  $link = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/projeto-ecogym/public/alter_password.php?token=' . $token;

  $subject = "Recuperar Senha - EcoGym";
  $message = "Clique no link para redefinir sua senha:\n\n$link\n\nEste link expira em 1 hora.";

  if(sendEmail($email, $subject, $message)) {
    echo json_encode(["status" => "success", "title" => "Enviado!", "message" => "Te enviamos um email com mais instruções."]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Falha no envio!", "message" => "Não foi possível enviar o email."]);