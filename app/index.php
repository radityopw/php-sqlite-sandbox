<?php 
require 'vendor/autoload.php';
require 'classes/config.php';

use Google\Cloud\Storage\StorageClient;

$storage = new StorageClient([
    'projectId' => getenv("GOOGLE_PROJECT_ID")
]);
$storage->registerStreamWrapper();

$path = @parse_url($_SERVER['REQUEST_URI'])['path'];

switch ($path) {
	
    case '/':
        require 'web/login.php';
        break;
	
	case '/login_auth';
		require 'web/login_auth.php';
        break;
	
    default:
        http_response_code(404);
        exit('Not Found');
}