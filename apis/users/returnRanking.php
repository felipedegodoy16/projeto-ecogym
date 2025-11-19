<?php 

  require_once __DIR__ . '/../files/logged.php';
  require_once __DIR__ . '/../../class/UserDAO.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $user = new User();
  $userDAO = new UserDAO($user);
    
  echo json_encode($userDAO->returnRanking());