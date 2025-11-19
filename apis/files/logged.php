<?php 
  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if(!$_SESSION['logged'] || $_SESSION['permissao'] !== 'A') {
    header('Location: http://localhost/projeto-ecogym/public/');
    exit();
  }
?>