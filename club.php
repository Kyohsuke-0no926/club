<?php require('dbconnect.php') ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css?v=2">
  <title>サークル名簿</title>
</head>
<body>
  <div id="wrap">
  <div id="head">
    <h1 class="font-weight-normal">サークル名簿</h1>
  </div>
  <div class="container">
  <div class="heading">
    <h2>サークル</h2>
  </div>
  <?php
    $sql = "SELECT * FROM club_name";
    if ($result = $db->query($sql)) {
      $count = $result->num_rows;
      $result->close(); 
    }
  ?>
  <div class="club-links">
  <?php
  $sql = "SELECT * FROM club_name";
  $club_names = [];
  if ($result = $db->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $club_names[]= $row;
      }
      $result->close();
  }

  for ($i=0; $i<$count; $i++):
  ?>
  <div class="club-link">
  <p><a href="member.php?id=<?php print($club_names[$i]['id']); ?>"><?php print($club_names[$i]['name']); ?></a></p>
  </div>
  <?php endfor ?>
  <div class="clear"></div>
  </div>
  <a class="link" href="index.html">戻る</a>
  </div>
  </div>
</body>
</html>