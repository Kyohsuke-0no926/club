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
  <h2>編集確認</h2>
</div>

<?php
$name_id = $_REQUEST['id'];

    if (isset($_REQUEST['club_name']) && !is_numeric($_REQUEST['club_name']) && isset($_REQUEST['grade']) && is_numeric($_REQUEST['grade']) && isset($_REQUEST['gender']) && isset($_REQUEST['student_number']) && isset($_REQUEST['my_name'])):
      $club_name = $_REQUEST['club_name'];
      $grade = $_REQUEST['grade'];
      $gender = $_REQUEST['gender'];
      $student_number = $_REQUEST['student_number'];
      $student_number = mb_convert_kana($student_number, 'a', 'UTF-8');
      $my_name = $_REQUEST['my_name'];

$club_ids = $db->prepare('SELECT * FROM club_name WHERE club_name.name=?');
$club_ids->execute(array($club_name));
$club_id = $club_ids->fetch();
$id = $club_id['id'];

$statement = $db->prepare('UPDATE club SET club_id=?, grade=?, gender=?, student_number=?, my_name=? WHERE id=?');
$statement->execute(array($id, $grade, $gender, $student_number, $my_name, $name_id));
echo '情報が編集されました';
?>

<p>サークル名: </p><?php print(htmlspecialchars($club_name, ENT_QUOTES)); ?>
<p>学年: </p><?php print(htmlspecialchars($grade, ENT_QUOTES)); ?>
<p>性別: </p><?php print(htmlspecialchars($gender, ENT_QUOTES)); ?>
<p>学籍番号: </p><?php print(htmlspecialchars($student_number, ENT_QUOTES)); ?>
<p>氏名: </p><?php print(htmlspecialchars($my_name, ENT_QUOTES)); ?>


<?php
    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])):
        $id = $_REQUEST['id'];
  
        $clubs = $db->prepare('SELECT * FROM club_name, club WHERE club.id=? and club.club_id=club_name.id');
        $clubs->execute(array($id));
        $club = $clubs->fetch();
      ?>
      <table class="figure" border="1">
        <tr>
          <th>サークル名</th>
          <th>学年</th>
          <th>性別</th>
          <th>学籍番号</th>
          <th>氏名</th>
        </tr>
        <tr>
          <th><?php print($club['name']); ?></th>
          <th><?php print($club['grade']); ?></th>
          <th><?php print($club['gender']); ?></th>
          <th><?php print($club['student_number']); ?></th>
          <th><?php print($club['my_name']); ?></th>
        </tr>
      </table>
    <?php endif ?>



<?php
$club_pages = $db->prepare('SELECT * FROM club_name WHERE name=?');
$club_pages->execute(array($club_name));
$club_page = $club_pages->fetch();
?>
</pre>

<article>
<a class="left link" href="member.php?id=<?php print($club_page['id']); ?>"><?php print($club_page['name']); ?>の一覧へ</a><p> | <a class="right link" href="update.php?id=<?php print($name_id); ?>">戻る</a></p>

<?php else: echo 'エラーが起こりました。再度編集してください。'; ?>
<p><a class="link" href="update.php?id=<?php print($name_id); ?>">戻る</a></p>

<?php endif ?>


</article>
</div>
</div>
</main>
</body>
</html>