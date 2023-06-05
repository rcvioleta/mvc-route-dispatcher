<?php

class RouteDispatcher
{
  private static $instance;
  private static $controller = 'Home';
  private static $method = 'index';
  private static $param = [];

  private function __construct()
  {
    $url = self::parseUrl();
    $currentController = $url[0] ? ucfirst($url[0]) : self::$controller;

    // print_r($url);

    if (!file_exists('app/controller/' . $currentController . '.php')) {
      require_once('app/controller/' . self::$controller . '.php');
      self::$controller = new self::$controller;
      self::handleNotFound();
      return;
    }

    self::$controller = $currentController;
    unset($url[0]);

    require_once('app/controller/' . self::$controller . '.php');
    self::$controller = new self::$controller;

    if (isset($url[1])) {
      if (!method_exists(self::$controller, $url[1])) {
        self::handleNotFound();
        return;
      }

      self::$method = $url[1];
      unset($url[1]);
    }

    self::$param = $url ? array_values($url) : [];
    print_r(self::$param);
    call_user_func_array([self::$controller, self::$method], self::$param);
  }

  private static function handleNotFound()
  {
    self::$method = 'notFound';
    call_user_func_array([self::$controller, self::$method], self::$param);
  }

  private static function parseUrl()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}
