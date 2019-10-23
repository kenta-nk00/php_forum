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
      <input type="hidden" value="<?= h($_SESSION["token"]) ?>" name="token">
      <?= h($app->getUserInfo()["email"]); ?> <input type="submit" value="LogOut">
    </form>

    <form>
      <p class="err"><?= h($app->getErrors("comment")); ?></p>
      <p class="err"><?= h($app->getErrors("token")); ?></p>
      <input type="text" value="" name="comment" class="form_comment">
      <!-- <input type="submit" value="送信"> -->
      <button type="button" id="button">送信</button>
    </form>

    <ul id="root_ul">

    </ul>
  </div>
</body>

<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>

<script>
  $.ajax({
    url : "./index.php",
    type : "POST",
    data : {
      token : "<?= h($_SESSION["token"]) ?>",
      id : 1
    }
  }).done(function(data) {
    let json = data.substr(0, data.indexOf("\n"));
    if(json !== "") {
      json = JSON.parse(json);

      clearComment();
      reloadComment(json);
    }
  }).fail(function(data) {

  }).always(function(data) {

  });

  $("#button").click(function() {

    $.ajax({
      url : "./index.php",
      type : "POST",
      data : {
        token : "<?= h($_SESSION["token"]) ?>",
        comment : $(".form_comment").val()
      }
    }).done(function(data) {
      let json = data.substr(0, data.indexOf("\n"));
      if(json !== "") {
        json = JSON.parse(json);

        clearComment();
        reloadComment(json);
      }
    }).fail(function(data) {

    }).always(function(data) {

    });

  });

  // コメント一覧再描画
  function reloadComment(data) {

    let allposts = data;

    for(let i = 0; i < allposts.length; i++) {

      let root_ul = document.getElementById("root_ul");
      let post = document.createElement("div");
      post.classList.add("post");

      let email = document.createElement("li");
      email.classList.add("email");
      email.textContent = allposts[i].email;

      let sub_ul = document.createElement("ul");

      let comment = document.createElement("li");
      comment.classList.add("comment");
      comment.textContent = allposts[i].comment;

      sub_ul.appendChild(comment);
      post.appendChild(email);
      post.appendChild(sub_ul);
      root_ul.appendChild(post);
    }
  }

  function clearComment() {
    let root_ul = document.getElementById("root_ul");

    while(root_ul.firstChild) {
      root_ul.removeChild(root_ul.firstChild);
    }
  }

</script>
</html>
