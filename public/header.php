<?php  
 session_start();

 $_SESSION['logged'] = $_SESSION['logged'] ?? false;

 require_once __DIR__ . '/../apis/files/logout.php';
?>