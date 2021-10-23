<?php
require('dbconnect.php');

function h($value) {
  return htmlspecialchars($value, ENT_QUOTES);
}
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
<?php
$id = $_REQUEST['id'];
$clubs = $db->prepare('SELECT * FROM club_name WHERE id=?');
$clubs->execute(array($id));
$club = $clubs->fetch()
?>
<div class="club-heading">
  <h2><?php echo h($club['name']); ?></h2>
</div>
<div class="subheading">
<h3>メンバー一覧</h3>
<?php

$counts = $db->prepare('SELECT COUNT(*) AS cnt FROM club WHERE club_id=?');
$counts->execute(array($id));
$count = $counts->fetch()
?>
<p class="count">人数: <?php echo h($count['cnt']); ?>人</p>
</div>

<table class="figure" border="1">
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
    <th> <?php echo($i); ?></th>
    <?php $i++; ?>
    <th><?php echo h($club_name['grade']); ?></th>
    <th><?php echo h($club_name['gender']); ?></th>
    <th><?php echo h($club_name['student_number']); ?></th>
    <th><?php echo h($club_name['first_name']). ' '. h($club_name['last_name']); ?></th>
    <th><a class="edit" href="update.php?id=<?php echo h($club_name['id']); ?>">編集</a></th>
    <th><a class="delete" href="delete.php?id=<?php echo h($club_name['id']); ?>">削除</a></th>
  </tr>
  <?php endwhile ?>
</table>
<a class="left link" href="index.php"><p>登録画面へ</p></a> | <a class="link" href="club.php"><p>サークル一覧へ</p></a>
</div>
</main>
</div>
</body>
</html>