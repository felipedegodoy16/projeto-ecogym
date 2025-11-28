<?php 

  require_once __DIR__ . '/../files/logged_admin.php';
  require_once __DIR__ . '/../../class/EquipDAO.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: DELETE");
  header("Access-Control-Allow-Headers: Content-Type");

  parse_str(file_get_contents("php://input"), $data);

  $id = $data['id'];

  $equip = new Equip();
  $equipDAO = new EquipDAO($equip);

  $equip->setId($id);
    
  echo json_encode($equipDAO->delete());