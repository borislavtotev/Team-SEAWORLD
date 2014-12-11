<?php
include_once( 'views/partials/header.php' );
include_once('views/partials/navbar.php');
include_once( 'system/models/user.php' );

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {

    mb_internal_encoding('UTF-8');

    // $userModel = new User();

    $username = (trim($_POST['username']));
    $password = trim($_POST['password']);
    $isLoginValid = false; // Default state

    //Ask the User module to validate login data
    // $isLoginValid = $userModel->validateLogin( $username, $password );

	if ($isLoginValid) {
	    $_SESSION['is_logged'] = true;
	    $_SESSION['username'] = $username;
	    header("Location: index.php");
	    exit();
    } else {
        $loginError = 'Грешен потребител или парола!';
    }
}
?>
<main class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Login</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control" id="inputEmail" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                            <div class="checkbox">
                                <label>
                                    <input name="rememberMe" type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php if (isset( $loginError )): ?>
    <div class="row">
        <div class="col-md-6">
            <p><?=$loginError?></p>
        </div>
    </div>
    <? endif; ?>
</main>
<?php include_once( 'views/partials/footer.php' ); ?>