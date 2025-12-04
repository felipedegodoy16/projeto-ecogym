<?php 

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require __DIR__ . '/../../PHPMailer/src/Exception.php';
  require __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
  require __DIR__ . '/../../PHPMailer/src/SMTP.php';

  function sendEmail($destiny, $subject, $body, $remetent = 'EcoGym') {

    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'ecogym.contato@gmail.com';
      $mail->Password = 'jjwy vipq fwow vnlp';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      if($remetent === 'no-reply') {
        $mail->addReplyTo('no-reply@ecogym.com', 'No-Reply');
      }
      
      $mail->setFrom('ecogym.contato@gmail.com', $remetent);
      $mail->addAddress($destiny);
      $mail->Subject = $subject;
      $mail->Body = $body;

      return $mail->send();

    } catch (Exception $e) {

      echo "Erro: {$mail->ErrorInfo}";
      
    }

  }