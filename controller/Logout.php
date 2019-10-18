<?php

namespace php_forum\controller;

class Logout extends \php_forum\controller\Controller{

  public function run() {

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->postProcess();
    }
  }

  private function postProcess() {
    $this->validate();

    // セッション変数削除
    $_SESSION = [];

    // クッキー削除
    if(isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 1, "/");
    }

    // セッション削除
    session_destroy();

    header("Location: " . SITE_URL . "/view/index.php");
  }

  // フォーム送信内容チェック
  private function validate() {
    try {
      $this->tokenValidate();
    } catch(\php_forum\exception\InvalidToken $e) {
      $this->setErrors("token", $e->getMessage());
    }
  }

  private function tokenValidate() {
    if(!isset($_POST["token"]) || $_POST["token"] !== $_SESSION["token"]) {
      throw new \php_forum\exception\InvalidToken();
    }
  }
}
