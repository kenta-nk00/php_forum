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
      <p class="err"><?= h($app->getErrors("comment")); ?></p>
      <input type="text" value="" name="comment">
      <input type="submit" value="投稿">
    </form>

    <ul>
      <?php for($i = 0; $i < count($app->getValues("Posts")); $i++) { ?>
        <div class="post">
          <li class="email">ID : <?= h($app->getValues("Posts")[$i]["email"]); ?></li>
          <ul>
            <li class="comment"><?= h($app->getValues("Posts")[$i]["comment"]); ?></li>
          </ul>
        </div>
      <?php } ?>
    </ul>

  </div>
</body>
</html>
