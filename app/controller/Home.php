<?php

class Home extends Controller
{
  public function index($param = null)
  {
    if (isset($param)) {
      echo '[Home.php] Hello, world! What is param? ' . $param;
    }
  }
}
