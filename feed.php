<html>

<head>
    <!-- Add the icon 'Back to top' button font library -->
    <link rel="stylesheet" id="font-awesome-css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"
          type="text/css" media="screen">
</head>
<body>
<!-- Add jQuery to use it for the icon 'Back to top' button -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<?php include_once( 'views/partials/header.php' ); ?>
<!--This section will replace the one called 'News'
    Here users will be able to see all photos, rate/comment them-->
<div class="container">
    <header class="row">
        <div class="col-md-12">
            <div class="jumbotron animated fadeInDownBig">
                <hgroup>
                    <h1 class="text-center">Feed</h1>
                </hgroup>
            </div>
    </header>
</div>
<!-- Add div for the icon 'Back to top' button -->
<div class="scroll-top-wrapper ">
	<span class="scroll-top-inner">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	</span>
</div>
<?php include_once( 'views/partials/footer.php' );
?>
</body>
</html>