<?php require('dbconnect.php'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>サークル名簿</title>
</head>
<body>
  <main>
    <h2>メンバー編集</h2>
    <?php
    if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
  
        $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
        $memos->execute(array($id));
        $memo = $memos->fetch();
      }
    ?>

    <form action="update_do.php" method="post">
    <input type="hidden" name="id" value="<?PHP print($id); ?>">
      <p>サークル名</p>
      
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
      <p>学年</p>
      <select name="grade">
        <option value="未入力">選択してください</option>
        <?php for ($i=1; $i<9; $i++): ?>
        <option value="<?php print($i); ?>"><?php print($i); ?></option>
        <?php endfor ?>
      </select>
      <p>性別:<input type="radio" name="gender" value="男"> 男性 |<input type="radio" name="gender" value="女"> 女性</p>
      <p>学籍番号</p>
      <input type="text" name="student_number">
      <p>氏名</p>
      <input type="text" id="my_name" name="my_name" maxlength="255">
      <button type="submit">再登録する</button>
    </form>
  </main>
    
</body>
</html>

