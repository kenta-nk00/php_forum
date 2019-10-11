<?php

require_once(__DIR__ . '/../lib/config/config.php');


$app = new php_forum\controller\Index();
$app->test();

$_SESSION['login_status'] = "セッションテスト";

//header('Location:' . SITE_URL . '/view/login.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ホーム</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>TEST</h1>
</body>
</html>
