<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$currentPage = preg_split( '/\//', $_SERVER[ 'REQUEST_URI' ], NULL, PREG_SPLIT_NO_EMPTY )[ 0 ];
?>
<div class="container">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php">Index</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <?php if ($currentPage == 'albums.php'): ?>
                <li class="active">
                <?php else: ?>
                <li>
                <?php endif; ?>
                    <a href="/albums.php">Albums</a>
                </li>
                <?php if ($currentPage == 'users.php'): ?>
                <li class="active">
                <?php else: ?>
                <li>
                <?php endif; ?>
                    <a href="/users.php">Users</a>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <input type="text" class="form-control col-lg-8" placeholder="Search">
            </form>
            <ul class="nav navbar-nav navbar-right">
            <?php if (isset( $_SESSION[ 'username' ], $_SESSION[ 'userid' ], $_SESSION[ 'is_logged' ] ) &&
                $_SESSION[ 'is_logged' ] === true): ?>
                <li>
                    <h4 class="greetings">
                        Welcome,
                        <a href="/profile.php">
                            <?= htmlspecialchars( $_SESSION[ 'username' ] ) ?>
                        </a>!
                    </h4>
                </li>
                <li>
                    <a class="btn btn-danger btn-lg" href="logout.php?redirectTo=<?=$currentPage?>">Logout</a>
                </li>
            <?php else: ?>
                <li>
                    <button type="button" class="btn btn-danger btn-md" data-modal-type="login" data-toggle="modal" data-target="#loginRegisterModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-danger btn-md" data-modal-type="register" data-toggle="modal" data-target="#loginRegisterModal">
                        Register
                    </button>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</div>