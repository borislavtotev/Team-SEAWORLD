<html>

<head>
    <!-- Add the icon 'Back to top' button font library -->
    <link rel="stylesheet" id="font-awesome-css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"
          type="text/css" media="screen">


</head>
<body>
<script>
    $(function(){
        $(document).on( 'scroll', function(){

            if ($(window).scrollTop() > 100) {
                $('.scroll-top-wrapper').addClass('show');
            } else {
                $('.scroll-top-wrapper').removeClass('show');
            }
        });

        $('.scroll-top-wrapper').on('click', scrollToTop);
    });

    function scrollToTop() {
        verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        element = $('body');
        offset = element.offset();
        offsetTop = offset.top;
        $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
    }
</script>

<!-- Add div for the icon 'Back to top' button -->
<div class="scroll-top-wrapper ">
	<span class="scroll-top-inner">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	</span>
</div>

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
                <?php
                for($i=9; $i<500; $i++){
                    ?>
                    <div class="tryButton">
                        Try to see if works
                    </div> <?php
                }
                ?>
            </div>


    </header>
</div>
<?php include_once( 'views/partials/footer.php' );
?>
</body>
</html>