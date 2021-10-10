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
    <h2>サークルメンバー登録</h2>
  </div>
    <form action="index_do.php" method="post">
    <div class="itmes">
      <div class="item"><p>サークル名</p></div>
      <select name="club_name">
        <option value="1">選択してください</option>
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
    </div>
      <div class="items">
        <div class="item"><p>学年</p></div>
        <select name="grade">
          <option value="未入力">選択してください</option>
          <?php for ($i=1; $i<9; $i++): ?>
          <option value="<?php print($i); ?>"><?php print($i); ?></option>
          <?php endfor ?>
        </select>
      </div>
      <div class="items">
        <div class="item"><p>性別</p></div>
        <p><input type="radio" name="gender" value="男"> 男性 |<input type="radio" name="gender" value="女"> 女性</p>
      </div>
      <div class="items">
        <div class="item"><p>学籍番号</p></div>
        <input type="text" name="student_number" class="input">
      </div>
      <div class="items">
        <div class="item"><p>氏名</p></div>
        <input type="text" id="my_name" name="my_name" class="input" maxlength="255">
      </div>
      <input type="submit" class="btn">
    </form>
    <a class="link" href="index.html">一覧へ</a>
  </div>
  </main>
</div>
</body>
</html>