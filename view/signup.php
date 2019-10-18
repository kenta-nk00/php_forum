<?php

require_once(__DIR__ . '/../lib/config.php');

$app = new \php_forum\controller\SignUp();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>会員登録</title>
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
        <input type="submit" value="登録">
      </p>
      <p class="fs12"><a href="./login.php">Login</a></p>
    </form>
  </div>
</body>
</html>
