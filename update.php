<?php
session_start();
require('dbconnect.php');


if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
  }
  
if (!empty($_POST)) {
  if ($_POST['gender'] == '') {
    $error['gender'] = 'blank';
  }
  $_POST['student_number'] = mb_convert_kana($_POST['student_number'], 'a', 'UTF-8');
  if (strlen($_POST['student_number']) != 6) {
    $error['student_number'] = 'length';
  }
  if ($_POST['student_number'] == '') {
    $error['student_number'] = 'blank';
  }
  if ($_POST['first_name'] == '') {
    $error['first_name'] = 'blank';
  }
  if ($_POST['last_name'] == '') {
    $error['last_name'] = 'blank';
  }
  if (empty($error)) {
    $member = $db->prepare('SELECT COUNT(*) AS cnt FROM club WHERE id=? AND NOT student_number=?');
    $member->execute(array($id, $_POST['student_number']));
    $recode = $member->fetch();

    if ($recode['cnt'] > 0) {
      $error = 'duplicate';
    }
  }
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: update_do.php');
    exit();
  }
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
  <meta name="viewport" content="width=
  , initial-scale=1.0">
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
    <h2>メンバー編集</h2>
  </div>
  <?php
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
          <th><?php echo h($club['name']); ?></th>
          <th><?php echo h($club['grade']); ?></th>
          <th><?php echo h($club['gender']); ?></th>
          <th><?php echo h($club['student_number']); ?></th>
          <th><?php echo h($club['first_name']). ' '. h($club['last_name']); ?></th>
        </tr>
      </table>
    
  

    <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo h($id); ?>">
      <p>サークル名</p>
      
      <select name="club_name">
        <option value="<?php echo h($club['name']); ?>"><?php echo h($club['name']); ?></option>
        <?php
        $counts = $db->query('SELECT COUNT(*) as cnt FROM club_name');
        $count = $counts->fetch();
        for ($i=1; $i<=$count['cnt']; $i++):
          $club_names = $db->prepare('SELECT * FROM club_name WHERE id=?');
          $club_names->execute(array($i));
          $club_name = $club_names->fetch();
        ?>
        <option value="<?php echo h($club_name['name']); ?>"><?php echo h($club_name['name']); ?></option>
        <?php endfor ?>
      </select>
      <p>学年</p>
      <select name="grade">
        <option value="<?php echo h($club['grade']); ?>"><?php echo h($club['grade']); ?></option>
        <?php for ($i=1; $i<9; $i++): ?>
        <option value="<?php echo h($i); ?>"><?php echo h($i); ?></option>
        <?php endfor ?>
      </select>
      <p>性別:<input type="radio" name="gender" value="男"> 男性 |<input type="radio" name="gender" value="女"> 女性</p>
      <p class="error">*恐れ入りますが、性別を指定して下さい</p>
      <p>学籍番号</p>
      <input type="text" name="student_number" value="<?php echo h($club['student_number']); ?>">
      <?php if ($error['student_number'] == 'length'): ?>
        <p class="error">*学籍番号は６桁で入力して下さい</p>
      <?php elseif ($error['student_number'] == 'duplicate'): ?>
        <p class="error">*学籍番号が既に登録されています</p>
      <?php elseif ($error['student_number'] == 'blank'): ?>
        <p class="error">*学籍番号を入力して下さい</p>
      <?php endif; ?>
      <p>氏名</p>
      <input type="text" id="first_name" name="first_name" maxlength="255" value="<?php echo h($club['first_name']); ?>">
      <input type="text" id="last_name" name="last_name" maxelength="255" value="<?php echo h($club['last_name']); ?>">
      <?php if ($error['first_name'] == 'blank'): ?>
        <p class="error">*苗字を入力して下さい</p>
      <?php endif; ?>
      <?php if ($error['last_name'] == 'blank'): ?>
        <p class="error">*名前を入力して下さい</p>
      <?php endif; ?>
      <div><a class="link" href="member.php?id=<?php echo h($club['club_id']); ?>">戻る</a> | <input class="input" type="submit" class="btn" value="再登録する"></div>
      
    </form>
  </div>
  </main>
</div>
</body>
</html>