<?php require('dbconnect.php') ?>
<!doctype html>
<html lang="ja">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="css/style.css">

<title>メモ帳</title>
</head>
<body>

<main>
<h2>メモ編集</h2>
<?php

$id = $_REQUEST['id'];
if(!is_numeric($id) || $id <= 0) {
  print('1以上の数字で指定してください');
  exit();
}

$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
$memos->execute(array($_REQUEST['id']));
$memo = $memos->fetch();

?>
<article>
  <pre><?php print($memo['memo']); ?></pre>
  <a href="update.php?id=<?php print($memo['id']); ?>">編集する</a>
  ｜
  <a href="delete.php?id=<?php print($memo['id']); ?>">削除する</a>
  ｜
  <a href="index.php">戻る</a>
</article>


</main>
</body>
</html>