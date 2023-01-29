<?php
$user = 'hmki';
$pass = 'hmki1331';
$date = $_POST['date'];
$time = $_POST['time'];
$amount = (int)$_POST['amount'];
$bikou = $_POST['bikou'];
$created_at = (int)$_POST['created_at'];
try {
  $dbh = new PDO('mysql:host=localhost;dbname=managedog;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO dogmng (date, time, amount, bikou, created_at) VALUES (?, ?, ?, ?, now())";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $date, PDO::PARAM_STR);//_INTでエラー
  $stmt->bindValue(2, $time, PDO::PARAM_STR);//_INTでエラー
  $stmt->bindValue(3, $amount, PDO::PARAM_INT);
  $stmt->bindValue(4, $bikou, PDO::PARAM_STR);
  $stmt->execute();
  $dbh = null;
  echo '登録完了だワン<br>';
  echo '<a href="index.php">健康管理表へ戻る</a>';
} catch (PDOException $e) {
  echo 'エラー発生： ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
  exit;
}
?>