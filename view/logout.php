<?php

require_once(__DIR__ . '/../lib/config.php');

$app = new \php_forum\controller\Logout();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログアウト</title>
  <link rel="stylesheet" href="./style/styles.css"/>
</head>
<body>
  <div id="container">
    <p class="err"><?= h($app->getErrors("token")); ?></p>
  </div>
</body>
</html>
