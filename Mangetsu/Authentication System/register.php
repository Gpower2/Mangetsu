<?php
	require_once 'core/init.php';
	
	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate -> check($_POST, array(
				'username' => array(
					'name' => 'Username',
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
				),
				'password' => array(
					'name' => 'Password',
					'required' => true,
					'min' => 6
				),
				'repeat_password' => array(
					'name' => 'Password Repeat',
					'required' => true,
					'matches' => 'password'
				),
				'email' => array(
					'name' => 'Email',
					'required' => true
				),
				'repeat_email' => array(
					'name' => 'Email Repeat',
					'required' => true,
					'matches' => 'email'
				)
			));
			
			if($validation -> passed()) {
				$user = new User();
				$salt = Hash::salt(32);
				try {
					$user -> create(array(
						'Username' => Input::get('username'),
						'Password' => Hash::make(Input::get('password'), $salt),
						'Salt' => $salt,
						'Email' => Input::get('email'),
						'Joined' => date('Y-m-d')
					));
					Session::flash('home', 'You have been registered and can now log in!');
					Redirect::to('index.php');
				}catch(Exception $e) {
					die($e -> getMessage());
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
				<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div>
			<div class="field">
				<label for="repeat_password">Repeat your Password</label>
				<input type="password" name="repeat_password" id="repeat_password">
			</div>
			<div class="field">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
			</div>
			<div class="field">
				<label for="repeat_email">Repeat your Email</label>
				<input type="text" name="repeat_email" id="repeat_email" value="<?php echo escape(Input::get('repeat_email')); ?>">
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="submit" value="Register">
		</form>
	</body>
</html>