<?php

define('ROOT_PATH', dirname(__DIR__) . '/'); 

function __autoload($class) {
	require_once ROOT_PATH . 'library/' . str_replace('\\', '/', $class) . '.php';
}