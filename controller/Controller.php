<?php

namespace php_forum\controller;

class Controller {

  private $_values;
  private $_errors;

  public function __construct() {

    $this->_values = Array();
    $this->_errors = Array();
  }

  protected function setValues($key, $value) {
    $this->_values[$key] = $value;
  }

  public function getValues() {
    return $this->_values;
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
    return !empty($this->_errors);
  }

  public function getUserInfo() {
    return $this->isLoggedIn() ? $_SESSION['user'] : null;
  }
}
