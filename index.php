<?php include_once( 'views/partials/header.php' ); ?>
<?php include_once( 'views/partials/navbar.html' ); ?>
<div class="container">
<?php
session_start();
if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true) {
	echo "<p>Welcome ".$_SESSION['username']."</p>"; //Say Wellcome only to logged users
}
?>
    <header class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="text-center">Programators!</h1>
                <h2 class="text-center">Изпрограмирайте се най - шашаво!</h2>
            </div>
        </div>
    </header>
    <main class="row">

    </main>
</div>

<?php include_once( 'views/partials/footer.php' ); ?>