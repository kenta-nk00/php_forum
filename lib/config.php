<?php

ini_set('display_errors', 1);

require_once(__DIR__ . '/const/const.php');
require_once(__DIR__ . '/function/functions.php');
require_once(__DIR__ . '/function/autoload.php');

session_start();

// セッション固定攻撃対策
session_regenerate_id(true);
