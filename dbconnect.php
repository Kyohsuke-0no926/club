<?php
  try {
    $db = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_4d0860ef942f6b0;charset=utf8','bebd1ac9c20308', 'e289300a');
  } catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMEssage();
  }
  ini_set('error_reporting', E_COMPILE_ERROR | E_RECOVERABLE_ERROR | E_ERROR | E_CORE_ERROR);
?>