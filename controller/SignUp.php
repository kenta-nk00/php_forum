<?php

namespace php_forum\controller;

class SignUp extends \php_forum\controller\Controller{

  public function run() {

    // ログインしていればトップページに遷移
    if($this->isLoggedIn()) {
      header("Location: " . SITE_URL . "/view/index.php");
      exit;
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->postProcess();
    }
  }

  private function postProcess() {
    $this->validate();

    if($this->hasError()) {
      return;
    }

    $userModel = new \php_forum\model\User();

    // データベース登録
    try {
      $userModel->signup(array(
        "email" => $_POST["email"],
        "password" => $_POST["password"]
      ));
    } catch(\php_forum\exception\DuplicateEmail $e) {
      $this->setErrors('email', $e->getMessage());
      return;
    }

    // 登録が完了したらログイン画面に遷移
    header("Location: " . SITE_URL . "/view/login.php");
    exit;
  }

  // フォーム送信内容チェック
  private function validate() {
    try {
      $this->tokenValidate();
    } catch(\php_forum\exception\InvalidToken $e) {
      $this->setErrors("token", $e->getMessage());
    }

    try {
      $this->emailValidate();
    } catch(\php_forum\exception\EmptyEmail $e) {
      $this->setErrors("email", $e->getMessage());
    } catch(\php_forum\exception\InvalidEmail $e) {
      $this->setErrors("email", $e->getMessage());
    }

    try {
      $this->passwordValidate();
    } catch(\php_forum\exception\EmptyPassword $e) {
      $this->setErrors("password", $e->getMessage());
    } catch(\php_forum\exception\InvalidPassword $e) {
      $this->setErrors("password", $e->getMessage());
    }
  }

  private function tokenValidate() {
    if(!isset($_POST["token"]) || $_POST["token"] !== $_SESSION["token"]) {
      throw new \php_forum\exception\InvalidToken();
    }
  }
  
  private function emailValidate() {
    if(!isset($_POST['email'])|| empty($_POST['email'])) {
      throw new \php_forum\exception\EmptyEmail();
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 100) {
      throw new \php_forum\exception\InvalidEmail();
    }
  }

  private function passwordValidate() {
    if(!isset($_POST['password'])|| empty($_POST['password'])) {
      throw new \php_forum\exception\EmptyPassword();
    }

    if(!preg_match("/^[a-zA-Z0-9]{8,100}$/", $_POST['password'])) {
      throw new \php_forum\exception\InvalidPassword();
    }
  }

}
