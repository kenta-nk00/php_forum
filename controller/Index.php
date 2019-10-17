<?php

namespace php_forum\controller;

class Index extends \php_forum\controller\Controller{

  public function run() {

    // ログインしていなければログイン画面に遷移
    if(!$this->isLoggedIn()) {
      header("Location: " . SITE_URL . "/view/login.php");
      exit;
    }

    $this->setAllPost();

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->postProcess();
    }
  }

  private function setAllPost() {
    $userModel = new \php_forum\model\User();
    $result = $userModel->getAllPost();

    if(!empty($result)) {
      $this->setValues("Posts", $result);
    }
  }

  private function postProcess() {
    $this->validate();

    if($this->hasError()) {
      return;
    }

    $userModel = new \php_forum\model\User();
    $userModel->postComment(array(
      "email" => $this->getUserInfo()["email"],
      "comment" => $_POST["comment"]
    ));

    // 投稿が完了したらトップ画面に遷移
    header("Location: " . SITE_URL . "/view/index.php");
    exit;
  }

  // フォーム送信内容チェック
  private function validate() {
    try {
      $this->commentValidate();
    } catch(\php_forum\exception\EmptyComment $e) {
      $this->setErrors("comment", $e->getMessage());
    } catch(\php_forum\exception\InvalidComment $e) {
      $this->setErrors("comment", $e->getMessage());
    }
  }

  private function commentValidate() {
    if(!isset($_POST['comment'])|| empty($_POST['comment'])) {
      throw new \php_forum\exception\EmptyComment();
    }

    if(strlen($_POST['comment']) > 255) {
      throw new \php_forum\exception\InvalidComment();
    }
  }

}
