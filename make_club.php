<?php require('dbconnect.php') ?>
<?php
  $sql = "insert into club_name (id, name) values (1, \"バスケットボール部\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (id, name) values (2, \"ボランティアサークル\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (id, name) values (3, \"弓道部\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (id, name) values (4, \"フットサルサークル\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (id, name) values (5, \"軽音サークル\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (id, name) values (6, \"野球部\")";
  $result = $db->query($sql);

  $sql = "insert into club_name (id, name) values (7, \"テニスサークル\")";
  $result = $db->query($sql);
?>