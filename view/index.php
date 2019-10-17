<?php

require_once(__DIR__ . '/../lib/config.php');

$app = new \php_forum\controller\Index();
$app->run();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>トップ</title>
  <link rel="stylesheet" href="./style/styles.css"/>
</head>
<body>
  <div id="container">
    <form action="./logout.php" method="post" id="logout">
      <?= h($app->getUserInfo()["email"]); ?> <input type="submit" value="LogOut">
    </form>

    <form action="" method="post">
      <p class="err">
        <?= h($app->getErrors("comment")); ?>
      </p>
      <input type="text" value="" name="comment">
      <input type="submit" value="投稿">
    </form>

    <ul>
      <?php foreach($app->getValues()["Posts"] as $user) : ?>
        <li><?= h($user["comment"]); ?></li>
      <?php endforeach; ?>
    </ul>

  </div>
</body>
</html>
