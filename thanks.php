<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['join'])) {
  $club_name = $_SESSION['join']['club_name'];
  $club_pages = $db->prepare('SELECT * FROM club_name WHERE name=?');
$club_pages->execute(array($club_name));
$club_page = $club_pages->fetch();

unset($_SESSION['join']);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
<div id="wrap">
  <div id="head">
    <h1 class="font-weight-normal">サークル名簿</h1>
  </div>
  
    <div class="thank"><a class="link" href="member.php?id=<?php print(htmlspecialchars($club_page['id'], ENT_QUOTES)); ?>"><?php print (htmlspecialchars($club_page['name'], ENT_QUOTES)); ?>の一覧へ</a> | <a class="link" href="index.php">登録画面へ</a></div>
</div>
</body>
</html>