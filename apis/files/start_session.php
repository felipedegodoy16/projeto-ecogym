<?php

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type");

  session_start();

  $_SESSION['logged'] = true;
  $_SESSION['id'] = $_GET['id'];
  $_SESSION['name'] = $_GET['name'];
  $_SESSION['email'] = $_GET['email'];
  $_SESSION['permissao'] = $_GET['permissao'];

  $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
  header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] . '/projeto-ecogym/public/');

?>