<?php 

  require_once __DIR__ . '/../PHPMailer/php_mailer_config.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $name = trim($datas['name']);
  $email = trim($datas['email']);
  $phone = trim($datas['phone']);
  $subject = trim($datas['subject']);
  $message = trim($datas['message']);

  $sql = "INSERT INTO mensagem (ID_MENSAGEM, NOME_MSG, TELEFONE_MSG, EMAIL_MSG, ASSUNTO, MENSAGEM) VALUES (DEFAULT, :nome, :phone, :email, :subject_message, :text_message);";

  // Conectando o banco e preparando a query
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":nome", $name, PDO::PARAM_STR);
  $stmt->bindValue(":phone", $email, PDO::PARAM_STR);
  $stmt->bindValue(":email", $phone, PDO::PARAM_STR);
  $stmt->bindValue(":subject_message", $subject, PDO::PARAM_STR);
  $stmt->bindValue(":text_message", $message, PDO::PARAM_STR);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if(!$stmt->rowCount()) {
    echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível enviar a mensagem."]);
    exit();
  }

  $pos = strpos($name, " ");

  $first_name = $name;

  if ($pos !== false) {
    $first_name = substr($name, 0, $pos);
  }

  $subject = "Recebemos seu feedback - EcoGym";
  $message = "Olá " . $first_name . "!\n\n"
            . "Ficamos felizes em receber seu feedback/dúvida. Assim que possível nossa equipe retornará seu contato.\n\n"
            . "Att, Equipe EcoGym.";

  if(sendEmail($email, $subject, $message)) {
    echo json_encode(["status" => "success", "title" => "Mensagem enviada!", "message" => "Seu feedback foi enviado, enviamos um email com mais informações."]);
    exit();
  }

  echo json_encode(["status" => "error", "title" => "Falha no envio!", "message" => "Não foi possível enviar o email."]);