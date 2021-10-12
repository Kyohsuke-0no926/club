<?php
// try {
  // $db = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_4d0860ef942f6b0;charset=utf8','bebd1ac9c20308', 'e289300a');
  // $db->query('SET character_set_client=utf8');
  // $db->query('SET character_set_results=utf8');
  // $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8','root', 'root');
// } catch (PDOException $e) {
//   echo 'DB接続エラー: ' . $e->getMEssage();
// }
  $db = new mysqli('mysql:host=us-cdbr-east-04.cleardb.com;','bebd1ac9c20308', 'e289300a', 'heroku_4d0860ef942f6b0');
  if ($db->connect_error) {
  echo $db->connect_error;
  exit();
} else {
  $db->set_charset("utf8");
}
?>