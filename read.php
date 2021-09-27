<?php
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}

if (null == $id) {
  header("Location: index.php");
} else {
  $pdo= Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM customers where id = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($id));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  Database::disconnect();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="span10 offset1">
      <div class="row">
        <h3>詳細ページ</h3>
      <div class="form-horizontal">
        <div class="control-group">
          <label class="control-label">名前</label>
          <div class="controls">
            <label class="checkbox">
              <?php echo $data['name']; ?>
            </label>
          </div>
        </div>  <!-- control-group 名前 -->
        <div class="control-group">
          <label class="control-label">メールアドレス</label>
          <div class="controls">
            <label class="checkbox">
              <?php echo $data['email']; ?>
            </label>
          </div>
        </div> <!-- control-group メールアドレス -->
        <div class="control-group">
          <label class="control-label">電話番号</label>
          <div class="controls">
            <label class="checkbox">
              <?php echo $data['mobile']; ?>
            </label>
          </div>
        </div> <!-- 電話番号 -->
        <div class="form-actions">
          <a class="btn" href="index.php">戻る</a>
        </div>
      </div> <!-- form-horizontal -->
      </div>
    </div>
  </div>
</body>
</html>