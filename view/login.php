<?php

require_once(__DIR__ . '/../lib/config.php');

$app = new \php_forum\controller\Login();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン画面</title>
  <link  rel="stylesheet" href="style/styles.css">
</head>
<body>
  <div id="container">
    <form action="" method="post">
      <p>
        <input type="text" name="email" value="" placeholder="email">
      </p>
      <p class="err"><?= h($app->getErrors("token")); ?></p>
      <p class="err">
        <?= h($app->getErrors("email")); ?>
      </p>
      <p>
        <input type="password" name="password" value="" placeholder="password">
      </p>
      <p class="err">
        <?= h($app->getErrors("password")); ?>
      </p>
      <input type="hidden" value="<?= h($_SESSION["token"]) ?>" name="token">
      <p>
        <input type="submit" value="ログイン">
      </p>
      <p class="fs12"><a href="./signup.php">Sign Up</a></p>
    </form>
  </div>
</body>
</html>
