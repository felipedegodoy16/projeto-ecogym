<?php 

  require_once __DIR__ . '/../files/logged_user.php';
  require_once __DIR__ . '/../../class/ConnectionFactory.php';

  // Define o fuso horário padrão para o Brasil (São Paulo)
  date_default_timezone_set('America/Sao_Paulo');

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $date = date('Y-m-d H:i:s');

  if(isset($datas['hip'])) {
    $sql = "INSERT INTO calculo_fisico (ID_CALCULO, DATA_CALCULO, PESO, CINTURA, PESCOCO, QUADRIL, IMC, PERC_GORDURA, KILO_GORDURA, FK_ID_USUARIO) VALUES (DEFAULT, :date_calc, :weight_user, :waist, :neck, :hip, :imc, :fat_perc, :fat_weight, :id_user);";
  } else {
    $sql = "INSERT INTO calculo_fisico (ID_CALCULO, DATA_CALCULO, PESO, CINTURA, PESCOCO, IMC, PERC_GORDURA, KILO_GORDURA, FK_ID_USUARIO) VALUES (DEFAULT, :date_calc, :weight_user, :waist, :neck, :imc, :fat_perc, :fat_weight, :id_user);";
  }
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":date_calc", $date, PDO::PARAM_STR);
  $stmt->bindValue(":weight_user", $datas['weight'], PDO::PARAM_STR);
  $stmt->bindValue(":waist", $datas['waist'], PDO::PARAM_INT);
  $stmt->bindValue(":neck", $datas['neck'], PDO::PARAM_INT);
  
  if(isset($datas['hip'])) {
    $stmt->bindValue(":hip", $datas['hip'], PDO::PARAM_INT);
  }

  $stmt->bindValue(":imc", $datas['imc'], PDO::PARAM_STR);
  $stmt->bindValue(":fat_perc", $datas['fatPerc'], PDO::PARAM_STR);
  $stmt->bindValue(":fat_weight", $datas['fatWeightRes'], PDO::PARAM_STR);
  $stmt->bindValue(":id_user", $_SESSION['id'], PDO::PARAM_INT);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if($stmt->rowCount()){

    echo json_encode(["status" => "success", "title" => "Sucesso!", "message" => "Cálculo salvo."]);
    exit();

  }
    
  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível salvar o cálculo."]);