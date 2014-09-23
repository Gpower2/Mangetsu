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
				try {
					$user -> update(array(
						'Email' => Input::get('email')
					));
					Session::flash('home', 'You profile has been updated!');
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
				<label for="email">New Email</label>
				<input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
			</div>
			<div class="field">
				<label for="repeat_email">Repeat your New Email</label>
				<input type="text" name="repeat_email" id="repeat_email" value="<?php echo escape(Input::get('repeat_email')); ?>">
			</div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="submit" value="Update">
		</form>
	</body>
</html>