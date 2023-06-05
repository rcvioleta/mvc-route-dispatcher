<?php

spl_autoload_register( function( $class ) {
  require_once( 'app/lib/' . $class . '.php' );
});

$router = RouteDispatcher::getInstance();
