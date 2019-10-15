<?php

namespace php_forum\controller;

class Index extends \php_forum\controller\Controller{

  public function run() {

    // ログインしていなければログイン画面に遷移
    if(!$this->isLoggedIn()) {
      header("Location: " . SITE_URL . "/view/login.php");
      exit;
    }

  }

}
