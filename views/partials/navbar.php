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
            <ul class="nav navbar-nav" id="navigation-up-left">
                <!-- Feed link -->
                <?php if (isset( $_SESSION[ 'username' ], $_SESSION[ 'userid' ], $_SESSION[ 'is_logged' ] ) && $_SESSION[ 'is_logged' ] === true): ?>
                    <?php if ($_SERVER[ 'REQUEST_URI' ] == 'news.php'): ?>
                        <li class="active">
                    <?php else: ?>
                        <li>
                    <?php endif; ?>
                    <a href="/news.php">News</a>
                    </li>
                <?php endif; ?>

                <!-- Albums link -->
                <?php if ($_SERVER[ 'REQUEST_URI' ] == 'albums.php'): ?>
                <li class="active">
                <?php else: ?>
                <li>
                <?php endif; ?>
                    <a href="/albums.php">Albums</a>
                </li>

                <!-- Users link -->
                <?php if ($_SERVER[ 'REQUEST_URI' ] == 'users.php'): ?>
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
            <?php if (isset( $_SESSION[ 'username' ], $_SESSION[ 'userid' ], $_SESSION[ 'is_logged' ] ) && $_SESSION[ 'is_logged' ] === true): ?>
                <li>
                    <h4 class="greetings">
                        Welcome,
                        <a href="/profile.php">
                            <?= htmlspecialchars( $_SESSION[ 'username' ] ) ?>
                        </a>!
                    </h4>
                </li>
                <li>
                    <button id="logoutBtn" class="btn btn-danger btn-md" data-href="logout.php?redirectTo=<?=$_SERVER[ 'REQUEST_URI' ]?>">Logout</button>
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