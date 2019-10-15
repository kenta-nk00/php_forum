<?php

// require_once(__DIR__ . '/../lib/config/config.php');

//var_dump($_GET(['aaa']));

session_start();


var_dump($_COOKIE['username']);


 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>テスト</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>TEST</h1>
  <form action="test.php">
  </form>
</body>
</html>
