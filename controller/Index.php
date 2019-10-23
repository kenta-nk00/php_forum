<?php

namespace php_forum\controller;

class Index extends \php_forum\controller\Controller{

  public function run() {

    // ログインしていなければログイン画面に遷移
    if(!$this->isLoggedIn()) {
      header("Location: " . SITE_URL . "/view/login.php");
      exit;
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      if(isset($POST['id']) === 1) {
        try {
          $this->tokenValidate();
        } catch(\php_forum\exception\InvalidToken $e) {
          $this->setErrors("token", $e->getMessage());
        }

        if($this->hasError()) {
          return;
        }

        $this->setAllPost();
        return;
      }

      $this->postProcess();
      $this->setAllPost();

    }
  }

  private function setAllPost() {
    $userModel = new \php_forum\model\User();
    $result = $userModel->getAllPost();

    if(!empty($result)) {
      echo json_encode($result);
      // $this->setValues("Posts", $result);
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

  }

  // フォーム送信内容チェック
  private function validate() {
    try {
      $this->tokenValidate();
    } catch(\php_forum\exception\InvalidToken $e) {
      $this->setErrors("token", $e->getMessage());
    }

    try {
      $this->commentValidate();
    } catch(\php_forum\exception\EmptyComment $e) {
      $this->setErrors("comment", $e->getMessage());
    } catch(\php_forum\exception\InvalidComment $e) {
      $this->setErrors("comment", $e->getMessage());
    }
  }

  private function tokenValidate() {
    if(!isset($_POST["token"]) || $_POST["token"] !== $_SESSION["token"]) {
      throw new \php_forum\exception\InvalidToken();
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
