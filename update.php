<?php
require 'database.php';

$id = null;
if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
if (null == $id) {
  header("Location: index.php");
}

if (!empty($_POST)) {
  $nameError = null;
  $emailError = null;
  $mobileError = null;

  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];

  $valid = true;
  if (empty($name)) {
    $nameError = '名前を入力してください';
    $valid = false;
  }
  if (empty($email)) {
    $emailError = 'メールアドレスを入力してください';
    $valid = false;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = '有効なメールアドレスにしてください';
    $valid = false;
  }
  if (empty($mobile)) {
    $mobileError = '電話番号を入力してください';
    $valid = false;
  }
  // データの更新処理
  if ($valid) {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE customers  set name = ?, email = ?, mobile =? WHERE id = ?";;
    $q = $pdo->prepare($sql);
    $q->execute(array($name, $email, $mobile, $id));
    Database::disconnect();
    header("Location: index.php");
  }
} else {
  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM customers where id = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($id));
  $data = $q->fetch(PDO::FETCH_ASSOC);
  $name = $data['name'];
  $email = $data['email'];
  $mobile = $data['mobile'];
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
        <h3>更新ページ</h3>
      </div>

      <form class="form-hrizontal" action="update.php?id=<?php echo $id ?>" method="post">
        <div class="control-group <?php echo !empty($nameError) ? 'error' : '' ?>">
          <label class="control-label">名前</label>
          <div class="controls">
            <input name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : '' ?>">
            <?php if (!empty($nameError)) : ?>
              <span class="help-inline"><?php echo $nameError; ?></span>
            <?php endif; ?>
          </div>
        </div>  <!--  control-group 名前 -->
        <div class="control-group <?php echo !empty($emailError) ? 'error' : '' ?>">
          <label class="control-label">メールアドレス</label>
          <div class="controls">
            <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email) ? $email : '' ?>">
            <?php if (!empty($emailError)) : ?>
              <span class="help-inline"><?php echo $emailError; ?></span>
            <?php endif; ?>
          </div>
        </div>  <!-- control-group メール -->
        <div class="control-group <?php echo !empty($mobileError) ? 'error' : '' ?>">
          <label class="control-label">電話番号</label>
          <div class="controls">
            <input name="mobile" type="text" placeholder="電話番号" value="<?php echo !empty($mobile) ? $mobile : '' ?>">
            <?php if (!empty($mobileError)) : ?>
              <span class="help-inline"><?php echo $mobileError; ?></span>
            <?php endif; ?>
          </div>
        </div>  <!-- controlgroup 電話番号 -->
        <div class="form-actions">
          <button type="submit" class="btn btn-success">作成</button>
          <a class="btn" href="index.php">戻る</a>
        </div>
      </form>

    </div>
  </div>
</body>
</html>