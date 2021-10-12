<?php require('dbconnect.php') ?>
<?php
  $sql = "insert into club_name (name) values (\"バスケットボール部\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (name) values (\"ボランティアサークル\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (name) values (\"弓道部\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (name) values (\"フットサルサークル\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (name) values (\"軽音サークル\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (name) values (\"野球部\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (name) values (\"テニスサークル\")";
  $result = $db->query($sql);
?>