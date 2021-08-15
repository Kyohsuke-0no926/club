<?php require('dbconnect.php') ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サークル名簿</title>
</head>
<body>
  <h1>サークル</h1>
  <?php
    $counts = $db->query('SELECT COUNT(*) as cnt FROM club_name');
    $count = $counts->fetch();
  for ($i=1; $i<=$count['cnt']; $i++):
    $club_names = $db->prepare('SELECT * FROM club_name WHERE id=?');
    $club_names->execute(array($i));
    $club_name = $club_names->fetch()
  ?>
  <p><a href="member.php?id=<?php print($club_name['id']); ?>"><?php print($club_name['name']); ?></a></p>
 <?php endfor ?>
</body>
</html>