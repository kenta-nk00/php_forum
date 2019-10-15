<?php

require_once(__DIR__ . '/../lib/config.php');

$app = new php_forum\controller\Login();
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
  <form action="" method="post">
    <p>
      <input type="text" name="email" value="" placeholder="email">
    </p>
    <p>
      <?= h($app->getErrors("email")); ?>
    </p>
    <p>
      <input type="password" name="password" value="" placeholder="password">
    </p>
    <p>
      <?= h($app->getErrors("password")); ?>
    </p>
    <p>
      <input type="submit" value="ログイン">
    </p>
  </form>
</body>
</html>
