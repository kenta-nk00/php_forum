<?php

namespace php_forum\controller;

class Login extends \php_forum\controller\Controller{

  public function run() {

    // ログインしていればトップページに遷移
    if($this->isLoggedIn()) {
      header("Location: " . SITE_URL . "/view/index.php");
      exit;
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->postProcess();
    }

    if($this->hasError()) {
      // return;
    }


  }

  private function postProcess() {
    try {
      $this->validate();
    } catch(\php_forum\exception\InvalidMail $e) {
      $this->setErrors("email", $e->getMessage());
    } catch(\php_forum\exception\InvalidPassword $e) {
      $this->setErrors("password", $e->getMessage());
    }
  }

  // フォーム送信内容チェック
  private function validate() {
    if(!isset($_POST['email'])|| empty($_POST['email'])) {
      echo "email";
      throw new \php_forum\exception\InvalidMail();
    }

    if(!isset($_POST['password'])|| empty($_POST['password'])) {
      echo "password";
      throw new \php_forum\exception\InvalidPassword();
    }

  }
}
