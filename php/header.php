<?php
  session_start(); 
  header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
  header("Pragma: no-cache"); // HTTP 1.0.
  header("Expires: 0"); // Proxies.
  require_once 'php/classes/i18n.class.php';
  require_once("php/classes/Login.class.php");
  $i18n = new i18n();
  $login = new Login();
?>