<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>AC</title>
    </head>
    <body>
		<?php
			require_once 'core/init.php';
			
			if(Session::exists('home')) {
				echo '<p>' . Session::flash('home') . '</p>';
			}
			
			$user = new User();
			if($user -> isLoggedIn()) {
		?>

				<p>Hello, <a href="profile.php?user=<?php echo escape($user -> data() -> ID); ?>"><?php echo escape($user -> data() -> Username); ?></a>!</p>
				<ul>
					<li><a href="logout.php">Log out</a></li>
					<li><a href="update.php">Update</a></li>
					<li><a href="changepassword.php">Change Password</a></li>
				</ul>
					
		<?php
			}else {
				echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a>!</p>';
			}
		?>
	</body>
</html>