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
  <p>
    <a href="create.php" class="btn btn-success">作成</a>
  </p>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>名前</th>
          <th>メールアドレス</th>
          <th>電話番号</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include 'database.php';
          $pdo = Database::connect();
          $sql = 'SELECT * FROM customers ORDER BY id DESC';
          foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['mobile'] . '</td>';
            echo '<td>';
              echo '<a class="btn" href="read.php?id=' . $row['id'] . '">詳細</a>';
              echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '">更新</a>';
              echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">削除</a>';
            echo '</td>';
            echo '</tr>';
          }
          Database::disconnect();
        ?>
      </tbody>
    </table>
  </div><!-- /container -->
</body>
</html>