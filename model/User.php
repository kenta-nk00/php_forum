<?php

namespace php_forum\model;

class User extends \php_forum\model\Model {

  // ユーザー登録処理
  public function signUp($values) {
    $sql = "insert into users(email, password) values(:email, :password)";
    $stmt = $this->db->prepare($sql);

    $result = $stmt->execute([
      ":email" => $values["email"],
      ":password" => password_hash($values["password"], PASSWORD_DEFAULT)
    ]);

    if(empty($result)) {
      throw new \php_forum\exception\DuplicateEmail();
    }
  }

  // ログイン処理
  public function logIn($values) {
    $sql = "select * from users where email = :email";
    $stmt = $this->db->prepare($sql);

    $stmt->execute([
      ":email" => $values["email"]
    ]);

    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if(empty($user)) {
      throw new \php_forum\exception\NotFoundEmail();
    }

    // パスワード認証
    if(!password_verify($values["password"], $user["password"])) {
      throw new \php_forum\exception\UnmatchPassword();
    }

    return $user;
  }

  // コメント投稿処理
  public function postComment($values) {
    $sql = "insert into posts(email, comment) values(:email, :comment)";
    $stmt = $this->db->prepare($sql);

    $result = $stmt->execute([
      ":email" => $values["email"],
      ":comment" => $values["comment"]
    ]);
  }

  // 全コメント取得
  public function getAllPost() {
    $sql = "select * from posts order by id";
    $stmt = $this->db->query($sql);

    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
  }

}
