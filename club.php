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
      $result->close(); // 結果セットを閉じる
    }
    // $counts = $db->query('SELECT COUNT(*) as cnt FROM club_name');
    // $count = $counts->fetch();
  ?>
  <div class="club-links">
  <?php
  $sql = "SELECT * FROM club_name";
  $club_names = [];
  if ($result = $mysqli->query($sql)) {
      // 連想配列を取得
      while ($row = $result->fetch_assoc()) {
        $club_names[]= $row["name"];
      }
      // 結果セットを閉じる
      $result->close();
  }

  for ($i=1; $i<=$count['cnt']; $i++):
    // $club_names = $db->prepare('SELECT * FROM club_name WHERE id=?');
    // $club_names->execute(array($i));
    // $club_name = $club_names->fetch()
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