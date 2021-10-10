<?php require('dbconnect.php'); ?>
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
  <main>
  <div class="container">
  <div class="heading">
    <h2>削除確認</h2>
  </div>
    <?php
    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
      $id = $_REQUEST['id'];
      $club_pages = $db->prepare('SELECT * FROM club WHERE id=?');
      $club_pages->execute(array($id));
      $club_page = $club_pages->fetch();
      $statement = $db->prepare('DELETE FROM club WHERE id=?');
      $statement->execute(array($id));
    }
    ?>
    <pre>
      <p>情報を削除しました</p>
    </pre>
    <p><a class="link" href="member.php?id=<?php print($club_page['club_id']); ?>">戻る</a></p>
  </div>
  </main>
</div>
</body>
</html>