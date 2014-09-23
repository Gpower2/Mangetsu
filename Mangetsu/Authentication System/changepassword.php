<?php
	require_once 'core/init.php';
	
	$user = new User();
	if(!$user -> isLoggedIn()) {
		Redirect::to('index.php');
	}
	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate -> check($_POST, array(
				'current_password' => array(
					'name' => 'Current Password',
					'required' => true,
					'min' => 6
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
			));
			
			if($validation -> passed()) {
				if(Hash::make(Input::get('current_password'), $user -> data() -> Salt) !== $user -> data() -> Password) {
					echo 'Your current password is wrong.';
				}else {
					$salt = Hash::salt(32);
					try {
						$user -> update(array(
							'Password' => Hash::make(Input::get('password'), $salt),
							'Salt' => $salt
						));
						Session::flash('home', 'Your password has been changed!');
						Redirect::to('index.php');
					}catch(Exception $e) {
						die($e -> getMessage());
					}
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
				<label for="current_password">Current Password</label>
				<input type="password" name="current_password" id="current_password">
			</div>
			<div class="field">
				<label for="password">New Password</label>
				<input type="password" name="password" id="password">
			</div>
			<div class="field">
				<label for="repeat_password">Repeat your Password</label>
				<input type="password" name="repeat_password" id="repeat_password">
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="submit" value="Change">
		</form>
	</body>
</html>