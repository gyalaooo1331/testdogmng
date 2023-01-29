<?php
$user = 'hmki';
$pass = 'hmki1331';
if (empty($_GET['id'])) {
  echo 'IDを正しく入力してください。';
  exit;
}
$id = (int)$_GET['id'];
try {
  $dbh = new PDO('mysql:host=localhost;dbname=managedog;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql ='SELECT * FROM dogmng WHERE id = ?';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $dbh = null;
} catch (PDOException $e) {
  echo 'エラー発生： ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>入力フォーム</title>
</head>
<body>
    変更<br>
    <form method="post" action="update.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES) ?>">
      日付：<input type="date" name="date" value="<?php echo htmlspecialchars($result['date'], ENT_QUOTES); ?>"><br>
      時間：<input type="time" name="time" value="<?php echo htmlspecialchars($result['time'], ENT_QUOTES); ?>"><br>
      量：<input type="number" name="amount" value="<?php echo htmlspecialchars($result['amount'], ENT_QUOTES); ?>">ml<br>
      備考：
      <textarea name="bikou" cols="20" rows="3" maxlength="60"><?= htmlspecialchars($result['bikou'], ENT_QUOTES) ?></textarea>
      <br>
      <input type="submit" value="変更">
    </form>
    <a href="index.php">健康管理表へ戻る</a>
</body>
</html>