<?php
require 'database.php';

$id = 0;

if (!empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
  $id = $_POST['id'];

  $pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM customers WHERE id = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array($id));
  Database::disconnect();
  header("Location: index.php");
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
        <h3>削除</h3>
      </div>
      <form class="form-horizontal" action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <p class="alert alert-error">本当に削除しますか？</p>
        <div class="form-actions">
          <button type="submit" class="btn btn-danger">はい</button>
          <a class="btn" href="index.php">いいえ</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>