<?php
	require_once 'core/init.php';
	
	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate -> check($_POST, array(
				'username' => array(
					'name' => 'Username',
					'required' => true
				),
				'password' => array(
					'name' => 'Password',
					'required' => true
				)
			));
			
			if($validation -> passed()) {
				$user = new User();
				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user -> login(Input::get('username'), Input::get('password'), $remember);
				if($login) {
					Redirect::to('index.php');
				}else {
					echo 'Logging in failed.';
				}
			}else {
				foreach($validation -> errors() as $error) {
					echo $error, '<br>';
				}
			}
		}
	}
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>AC</title>
    </head>
    <body>
		<form action="" method="post">
			<div class="field">
				<label for="username">Username</label>
				<input type="text" name="username" id="username">
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div>
			<div class="field">
				<label for="remember">
					<input type="checkbox" name="remember" id="remember"> Remember me
				</label>
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="submit" value="Log in">
		</form>
	</body>
</html>