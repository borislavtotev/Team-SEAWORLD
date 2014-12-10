<?php include_once( 'views/partials/header.php' ); ?>
<?php include_once( 'views/partials/navbar.html' ); ?>
<?php
session_start();

//If the user is logged, it will log out automatically
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true) {
	session_destroy();
	header("Location: index.php");
	exit();
}

if (isset($_POST['login'])) {

    mb_internal_encoding('UTF-8');

    $username = (trim($_POST['username']));
    $password = trim($_POST['password']);

	if (true) { //To do logic to check the users username and password (depends on the database)
	    $_SESSION['is_logged'] = true;
	    $_SESSION['username'] = $username;
	    header("Location: index.php");
	    exit();
    } else {
        echo '<p>Грешен потребител/парола.</p>';
    }
}
?>
<div class="container">
	<h1>Login</h1>
	<div class="form">
		<form method="POST" action="login.php">
		    <label>User</label><input type="text" name="username" /><br>
			<label>Password</label><input type="password" name="password" /><br>
			<input type="submit" name="login" value="Login" /></td>
		</form>		
	</div>
</div>
<?php include_once( 'views/partials/footer.php' ); ?>