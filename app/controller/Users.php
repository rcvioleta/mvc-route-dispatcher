<?php

class Users extends Controller
{
  public function index($param = null)
  {
    if (isset($param)) {
      echo '[Users.php] Hello, world! What is param? ' . $param;
    }
  }

  public function register()
  {
    echo '[Users.php] User registered';
  }
}
