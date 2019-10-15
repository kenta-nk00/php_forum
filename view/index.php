<?php

require_once(__DIR__ . '/../lib/config.php');

$app = new php_forum\controller\Index();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ホーム</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>HOME</h1>
  <input type='button' onclick="location.href='./login.php'" value="遷移">
</body>
</html>
