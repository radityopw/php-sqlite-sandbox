<?php 
require 'vendor/autoload.php';
require 'classes/config.php';
require 'classes/user.php';

use Google\Cloud\Storage\StorageClient;

$config = new Config();

$storage = new StorageClient([
    'projectId' => $config->projectId()
]);
$storage->registerStreamWrapper();

$path = @parse_url($_SERVER['REQUEST_URI'])['path'];

switch ($path) {
	
    case '/':
		$is_auth = 1;
        require 'web/login.php';
        break;
	
	case '/login_auth':
		require 'web/login_auth.php';
		if(!$is_auth){
			require 'web/login.php';
		}else{
			header('location: /home');
		}
        break;
	
	/* blok case /create_admin harap di disable saat di production */
	case '/create_admin':
		$u = new User();
		$u->username = 'admin@admin.adm';
		$u->password = 'password';
		$u->role = 'admin';
		$u->save();
		break;
	
    default:
        http_response_code(404);
        exit('Not Found');
		
}