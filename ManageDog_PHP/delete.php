<?php
$user = 'hmki';
$pass = 'hmki1331';
if (empty($_GET['id'])) {
  echo 'IDを正しく入力してください。';
  exit;
}
try {
  $id = (int)$_GET['id'];
  $dbh = new PDO('mysql:host=localhost;dbname=managedog;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM dogmng WHERE id = ?";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $dbh = null;
  echo '削除完了だワン<br>';
  echo '<a href="index.php">健康管理表へ戻る</a>';
} catch (PDOException $e) {
  echo 'エラー発生： ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
  exit;
}
?>