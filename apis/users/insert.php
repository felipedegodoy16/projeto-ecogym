<?php 

  require_once __DIR__ . '/../../class/UserDAO.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $name = trim($datas['register-name']);
  $email = trim($datas['register-email']);
  $password = trim($datas['register-password']);

  $user = new User();
  $userDAO = new UserDAO($user);

  $user->setName($name);
  $user->setEmail($email);
  $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
    
  echo json_encode($userDAO->insertPreRegister());