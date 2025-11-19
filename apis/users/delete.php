<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/UserDAO.php';
  
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: DELETE");
  header("Access-Control-Allow-Headers: Content-Type");

  parse_str(file_get_contents("php://input"), $data);

  $id = $data['id'];

  $user = new User();
  $userDAO = new UserDAO($user);

  $user->setId($id);
    
  echo json_encode($userDAO->delete());