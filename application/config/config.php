<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://172.17.3.234/mdpu/');
define('view', 'application/views/');
define('UD','application/templates/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */

define('APP_DIR', getcwd());
define('APP_MODUL',getcwd().'/application/modules');
define('DS',DIRECTORY_SEPARATOR );
define ('PS',PATH_SEPARATOR);
define('APPLICATION_DATA_PATH' , APP_DIR.'/log');

$includePath = array(
        get_include_path (),
        dirname(dirname(dirname(__FILE__))) . DS .'library',
);

set_include_path ( implode(PS, $includePath) );
require_once 'Mydb.php';
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Zend_');
$autoloader->registerNamespace('Mydb_');