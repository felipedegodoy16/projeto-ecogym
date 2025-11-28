<?php 

  require_once __DIR__ . '/../files/logged_admin.php';
  require_once __DIR__ . '/../../class/UserDAO.php';

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  $users = new User();
  $usersDAO = new UserDAO($users);

  echo json_encode($usersDAO->selectUsers());
?>