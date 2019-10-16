<?php

require_once(__DIR__ . '/../lib/config.php');

// $app = new \php_forum\controller\Index();
// $app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ホーム</title>
  <link rel="stylesheet" href="style/styles.css">
</head>
<body>
  <div id="container">
    <h1>HOME</h1>
    <p><script>console.log(document.cookie = "PHPSESSID=てすと; path=/")</script></p>
    <p><script>console.log(document.cookie)</script></p>
    <input type='button' onclick="location.href='./login.php'" value="遷移">
  </div>
</body>
</html>
