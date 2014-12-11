<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
                <li class="active"><a href="#">Articles</a></li>
                <li><a href="#">Gallery</a></li>
            </ul>
            <form class="navbar-form navbar-left">
                <input type="text" class="form-control col-lg-8" placeholder="Search">
            </form>
            <ul class="nav navbar-nav navbar-right">
            <?php if (isset( $_SESSION[ 'username' ], $_SESSION[ 'userid' ], $_SESSION[ 'is_logged' ] ) &&
                $_SESSION[ 'is_logged' ] === true): ?>
                <li>
                    <h4 class="greetings">
                        Welcome, <?= htmlspecialchars( $_SESSION[ 'username' ] ) ?>!
                    </h4>
                </li>
                <li>
                    <a class="btn btn-danger btn-lg" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li>
                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#loginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#registerModal">
                        Register
                    </button>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</div>