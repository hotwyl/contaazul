<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php';

switch ($_SERVER['HTTP_REFERER']) {
        case 'https://dev.3wonline.com/prod/':
                define('BASE_URL', 'https://dev.3wonline.com/prod/contaazul');
                break;

        default:
                define('BASE_URL', 'http://localhost/prod/contaazul');
                break;
}


spl_autoload_register(function ($class) {
        if (strpos($class, 'Controller') > -1) {
                if (file_exists('controllers/' . $class . '.php')) {
                        require_once 'controllers/' . $class . '.php';
                }
        } elseif (file_exists('models/' . $class . '.php')) {
                require_once 'models/' . $class . '.php';
        } elseif (file_exists('core/' . $class . '.php')) {
                require_once 'core/' . $class . '.php';
        }
});

$core = new Core();
$core->run();
