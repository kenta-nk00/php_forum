<?php

namespace php_forum\controller;

class Logout extends \php_forum\controller\Controller{

  public function run() {

    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $this->postProcess();
    }
  }

  private function postProcess() {

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

}
