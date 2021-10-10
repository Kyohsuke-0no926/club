<?php require('dbconnect.php'); ?>
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
  

    <form action="update_do.php" method="post">
    <input type="hidden" name="id" value="<?php print($id); ?>">
      <p>サークル名</p>
      
      <select name="club_name">
        <option value="<?php echo htmlspecialchars($club['name'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($club['name'], ENT_QUOTES, 'UTF-8'); ?></option>
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
        <option value="<?php echo htmlspecialchars($club['grade'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($club['grade'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php for ($i=1; $i<9; $i++): ?>
        <option value="<?php print($i); ?>"><?php print($i); ?></option>
        <?php endfor ?>
      </select>
      <p>性別:<input type="radio" name="gender" value="男"> 男性 |<input type="radio" name="gender" value="女"> 女性</p>
      <p>学籍番号</p>
      <input type="text" name="student_number" value="<?php echo htmlspecialchars($club['student_number'], ENT_QUOTES, 'UTF-8'); ?>">
      <p>氏名</p>
      <input type="text" id="my_name" name="my_name" maxlength="255" value="<?php echo htmlspecialchars($club['my_name'], ENT_QUOTES, 'UTF-8'); ?>">
      <button type="submit" class="btn">再登録する</button>
    </form>
    <a class="link" href="member.php?id=<?php print($club['club_id']); ?>">戻る</a>
  </div>
  </main>
</div>
</body>
</html>

