<?php

namespace php_forum\model;

class User extends \php_forum\model\Model {

  public function signUp($values) {
    $stmt = $this->db->prepare("insert into users(email, password) values(:email, :password)");
    $result = $stmt->excute([
      ":email" => values["email"],
      ":password" => values["password"]
    ]);

    var_dump($result);
  }

}
