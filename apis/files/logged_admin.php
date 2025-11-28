<?php 
  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if(!$_SESSION['logged'] || $_SESSION['permissao'] !== 'A') {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
    header('Location: ' . $protocol . '://' . $_SERVER['HTTP_HOST'] . '/projeto-ecogym/public/');
    exit();
  }
?>