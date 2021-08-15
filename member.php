<?php require('dbconnect.php'); ?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="css/style.css">

<title>サークル名簿</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">サークル名簿</h1>
</header>

<main>

<?php
$id = $_REQUEST['id'];
$clubs = $db->prepare('SELECT * FROM club_name WHERE id=?');
$clubs->execute(array($id));
$club = $clubs->fetch()
?>
<h2><?php print($club['name']); ?></h2>
<h3>メンバー一覧</h3>
<?php

$counts = $db->prepare('SELECT COUNT(*) AS cnt FROM club WHERE club_id=?');
$counts->execute(array($id));
$count = $counts->fetch()
?>
<p>人数: <?php print($count['cnt']); ?>人</p>

<table border="1">
  <tr>
    <th>番号</th>
    <th>学年</th>
    <th>性別</th>
    <th>学籍番号</th>
    <th>氏名</th>
    <th>編集</th>
    <th>削除</th>
  </tr>
  <?php
$i=1;
$club_names = $db->prepare('SELECT * FROM club_name, club WHERE club_name.id=? AND club_name.id=club.club_id');
$club_names->execute(array($id));
  while ($club_name = $club_names->fetch()):?>
  <tr>
    <th> <?php print($i); ?></th>
    <?php $i++; ?>
    <th><?php print($club_name['grade']); ?></th>
    <th><?php print($club_name['gender']); ?></th>
    <th><?php print($club_name['student_number']); ?></th>
    <th><?php print($club_name['my_name']); ?></th>
    <th><a href="update.php?id=<?php print($club_name['id']); ?>">編集</a></th>
    <th><a href="delete.php?id=<?php print($club_name['id']); ?>">削除</a></th>
  </tr>
  <?php endwhile ?>
</table>
<a href="index.php"><p>登録画面へ</p></a>
</main>
</body>
</html>