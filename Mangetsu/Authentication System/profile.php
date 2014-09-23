<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>AC</title>
    </head>
    <body>
		<?php
			require_once 'core/init.php';
			
			if(!$userID = Input::get('user')) {
				Redirect::to('index.php');
			}else {
				$user = new User($userID);
				if(!$user -> exists()) {
					Redirect::to(404);
				}else {
					$data = $user -> data();
				}
		?>
				<h3><?php echo escape($data -> Username)?></h3>
		<?php
			}
		?>
	</body>
</html>