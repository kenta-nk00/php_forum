<?php

namespace php_forum\controller;

class Controller {

  private $_errors;

  function __construct() {
    session_start();

    $this->_errors = array();
  }

  // ログイン中状態をセッション変数"user"で表す
  protected function isLoggedIn() {
    return isset($_SESSION["user"]);
  }

  protected function setErrors($key, $message) {
    $this->_errors[$key] = $message;
  }

  public function getErrors($key) {
    return isset($this->_errors[$key]) ? $this->_errors[$key] : "";
  }

  protected function hasError() {
    return count($this->_errors) > 0;
  }
}
