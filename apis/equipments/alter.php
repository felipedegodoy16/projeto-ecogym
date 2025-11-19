<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/EquipDAO.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: PUT");
  header("Access-Control-Allow-Headers: Content-Type");

  $id = $_GET['id'];

  $datas = json_decode(file_get_contents("php://input"), true);

  $name = trim($datas['equip-name']);
  $kcal = trim($datas['equip-kcal']);
  $situation = trim(strtoupper($datas['equip-situation']));

  $equip = new Equip();
  $equipDAO = new EquipDAO($equip);

  $equip->setId($id);
  $equip->setName($name);
  $equip->setKcal($kcal);
  $equip->setSituation($situation);
    
  echo json_encode($equipDAO->alter());