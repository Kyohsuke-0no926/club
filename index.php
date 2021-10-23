<?php
session_start();
require('dbconnect.php');
if ($_SERVER['REQUEST_URI'] == "/"){
  header('Location: index.html', true, 301);
  exit();
}
if (!empty($_POST)) {
  if ($_POST['club_name'] == '未入力') {
    $error['club_name'] = 'blank';
  }
  if ($_POST['grade'] == '未入力') {
    $error['grade'] = 'blank';
  }
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
    $member = $db->prepare('SELECT COUNT(*) AS cnt FROM club WHERE student_number=?');
    $member->execute(array($_POST['student_number']));
    $recode = $member->fetch();
    if ($recode['cnt'] > 0) {
      $error['student_number'] = 'duplicate';
    }
  }
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: index_do.php');
    exit();
  }
}

if ($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['join'];
  $error['rewrite'] = 'true';
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
    <h2>サークルメンバー登録</h2>
  </div>
    <form action="" method="post">
    <div class="itmes">
      <div class="item"><p>サークル名</p></div>
      <select name="club_name">
        <?php if (empty($error)): ?>
        <option value="未入力">選択してください</option>
        <?php else: ?>
        <option value="<?php echo h($_POST['club_name']); ?>"><?php echo h($_POST['club_name']); ?></option>
        <?php endif; ?>
        <?php
        $counts = $db->query('SELECT COUNT(*) as cnt FROM club_name');
        $count = $counts->fetch();
        for ($i=1; $i<=$count['cnt']; $i++):
          $club_names = $db->prepare('SELECT * FROM club_name WHERE id=?');
          $club_names->execute(array($i));
          $club_name = $club_names->fetch();
        ?>
        <option value="<?php print($club_name['name']); ?>"><?php print($club_name['name']); ?></option>
        <?php endfor ?>
      </select>
      <?php if ($error['club_name'] == 'blank'): ?>
        <p class="error">*クラブを選択して下さい</p>
      <?php endif; ?>
    </div>
      <div class="items">
        <div class="item"><p>学年</p></div>
        <select name="grade">
          <?php if (empty($error)): ?>
            <option value="未入力">選択してください</option>
          <?php else: ?>
          <option value="<?php echo h($_POST['grade']); ?>"><?php echo h($_POST['grade']); ?></option>
          <?php endif; ?>
          <?php for ($i=1; $i<9; $i++): ?>
          <option value="<?php print($i); ?>"><?php print($i); ?></option>
          <?php endfor ?>
        </select>
      <?php if ($error['grade'] == 'blank'): ?>
        <p class="error">*年齢を指定して下さい</p>
      <?php endif; ?>
      </div>
      <div class="items">
        <div class="item"><p>性別</p></div>
        <input type="radio" name="gender" value="男"> 男性 |<input type="radio" name="gender" value="女"> 女性
      <?php if (!empty($error)): ?>
        <p class="error">*恐れ入りますが、性別を指定して下さい</p>
      <?php endif; ?>
      </div>
      <div class="items">
        <div class="item"><p>学籍番号</p></div>
        <input type="text" name="student_number" class="input" value="<?php echo h($_POST['student_number']); ?>">
      <?php if ($error['student_number'] == 'length'): ?>
        <p class="error">*学籍番号は６桁入力して下さい</p>
      <?php elseif ($error['student_number'] == 'duplicate'): ?>
        <p class="error">*指定された学籍番号は既に登録されています</p>
      <?php elseif ($error['student_number'] == 'blank'): ?>
        <p class="error">*学籍番号を入力して下さい</p>
      <?php endif; ?>
      </div>
      <div class="items">
        <div class="item"><p>氏名</p></div>
        <input type="text" id="first_name" name="first_name" class="input" maxlength="255" value="<?php echo h($_POST['first_name']); ?>">
        <input type="text" id="last_name" name="last_name" class="input" maslength value="<?php echo h($_POST['last_name']) ?>">
        <?php if ($error['first_name'] == 'blank'): ?>
          <p class="error">*苗字を入力して下さい</p>
        <?php endif; ?>
        <?php if ($error['last_name'] == 'blank'): ?>
          <p class="error">*名前を入力して下さい</p>
        <?php endif; ?>
      </div>
      <a class="link" href="index.html">一覧へ</a> | <input type="submit" class="btn" value="入力内容を確認する">
    </form>
    
  </div>
  </main>
</div>
</body>
</html>