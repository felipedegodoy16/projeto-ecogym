<?php 

  require_once __DIR__ . '/../../class/UserDAO.php';

  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if($_SESSION['logged']) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] . '/projeto-ecogym/public/');
    exit();
  }

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $datas = json_decode(file_get_contents("php://input"), true);

  $email = trim($datas['user-email']);
  $password = trim($datas['user-password']);

  $user = new User();
  $userDAO = new UserDAO($user);

  $user->setEmail($email);
  $user->setPassword($password);
    
  echo json_encode($userDAO->login());