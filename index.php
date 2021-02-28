<?php
ob_start("ob_gzhandler");
header('Access-Control-Allow-Origin: *');
ini_set("display_errors", "On");
error_reporting( E_ERROR | E_COMPILE_ERROR | E_CORE_ERROR | E_RECOVERABLE_ERROR | E_USER_ERROR | E_PARSE );
//error_reporting(E_ALL);
//Getting the absolute path of the project
define ( 'PATH', dirname ( __FILE__ ) );


// Locally
define ( 'MAIN_URL', 'http://localhost/thirteencube/plumbers/');
define ( 'BASE_URL', 'http://localhost/thirteencube/plumbers/public/' );

//ONLINE
 
// define ( 'MAIN_URL', 'http://plumbers-lb.com/');
// define ( 'BASE_URL', 'http://plumbers-lb.com/public/' ); 


/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
// chdir(dirname(__DIR__));

 // Setup autoloading
require 'init_autoloader.php';

 // Require Dao files
require_once 'module/Application/src/Application/Model/include_dao.php';

define ( 'BASE_PATH', PATH . '/' );
define ( 'image_dir', 'images/');
define ( 'upload_image_dir', 'uploads/images/' );
define ( 'upload_file_dir', 'uploads/files/' );

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
ob_end_flush();