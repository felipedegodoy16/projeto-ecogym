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

  $date = date('Y-m-d');
  $hour = date('H:i:s');

  $sql = "INSERT INTO movimento (ID_MOVIMENTO, FK_USUARIO_ID, FK_EQUIPAMENTO_ID, INICIO, FIM, DATA_MOVIMENTO, CALORIA_GASTA) VALUES (DEFAULT, :id_user, :id_equip, :start_hour, :end_hour, :date_moviment, :kcal);";
  
  $stmt = ConnectionFactory::getConnection()->prepare($sql);

  $stmt->bindValue(":id_user", $_SESSION['id'], PDO::PARAM_INT);
  $stmt->bindValue(":id_equip", intval($datas['movi-equip']), PDO::PARAM_INT);
  $stmt->bindValue(":start_hour", $hour, PDO::PARAM_STR);
  $stmt->bindValue(":end_hour", $hour, PDO::PARAM_STR);
  $stmt->bindValue(":date_moviment", $date, PDO::PARAM_STR);
  $stmt->bindValue(":kcal", $datas['movi-kcal'], PDO::PARAM_STR);
  
  $stmt->execute() or die(print_r($stmt->errorInfo(), true));

  if($stmt->rowCount()){

    $sql = "SELECT NOME FROM equipamento WHERE ID_EQUIPAMENTO = :id_equip;";
  
    $stmt = ConnectionFactory::getConnection()->prepare($sql);

    $stmt->bindValue(":id_equip", intval($datas['movi-equip']), PDO::PARAM_INT);
    
    $stmt->execute() or die(print_r($stmt->errorInfo(), true));
    $equip = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

    echo json_encode(["status" => "success", "title" => "Sucesso!", "message" => "Registro salvo.", "date" => $date, "equip" => $equip]);
    exit();
  }
    
  echo json_encode(["status" => "error", "title" => "Erro!", "message" => "Não foi possível salvar o movimento."]);