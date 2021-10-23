<?php
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])) {
  header('Location: update.php');
  exit();
}

$name_id = $_SESSION['join']['id'];
$club_name = $_SESSION['join']['club_name'];
$grade = $_SESSION['join']['grade'];
$gender = $_SESSION['join']['gender'];
$student_number = $_SESSION['join']['student_number'];
$first_name = $_SESSION['join']['first_name'];
$last_name = $_SESSION['join']['last_name'];

if (!empty($_POST)) {
  $club_ids = $db->prepare('SELECT * FROM club_name WHERE club_name.name=?');
  $club_ids->execute(array($club_name));
  $club_id = $club_ids->fetch();
  $id = $club_id['id'];

  $statement = $db->prepare('UPDATE club SET club_id=?, grade=?, gender=?, student_number=?, first_name=? ,last_name=? WHERE id=?');
  $statement->execute(array($id, $grade, $gender, $student_number, $first_name, $last_name, $name_id));

  header('Location: thanks.php');
  exit();
}
function h($value) {
  return htmlspecialchars($value, ENT_QUOTES);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
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
  <h2>編集確認</h2>
</div>


<form action="" method="post">
  <input type="hidden" name="action" value="submit">
  <h3 class="check">サークル名: <?php echo h($club_name); ?></h3>
  <h3 class="check">学年: <?php echo h($grade). ' '. '年'; ?></h3>
  <h3 class="check">性別: <?php echo h($gender); ?></h3>
  <h3 class="check">学籍番号: <?php echo h($student_number); ?></h3>
  <h3 class="check">氏名: <?php echo h($first_name). ' '. h($last_name); ?></h3>

<?php
$club_pages = $db->prepare('SELECT * FROM club_name WHERE name=?');
$club_pages->execute(array($club_name));
$club_page = $club_pages->fetch();
?>
<div><a class="link" href="update.php?id=<?php echo h($_SESSION['join']['id']); ?>">&laquo;&nbsp;書き直す</a> | <input type="submit" class="btn" value="再登録する"></div>
</form>

</div>
</div>
</main>
</body>
</html>