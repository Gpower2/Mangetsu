<?php
    session_start();
	
	spl_autoload_register(function($class) {
		require_once 'classes/' . $class . '.php';
	});
	require_once 'functions/sanitize.php';
	
	if(Cookie::exists('hash') && !Session::exists('user')) {
		$hash = Cookie::get('hash');
		$hashCheck = Database::getInstance() -> get('users_session', array('Hash', '=', $hash));
		if($hashCheck -> count()) {
			$user = new User($hashCheck -> first() -> UserID);
			$user -> login();
		}
	}
?>