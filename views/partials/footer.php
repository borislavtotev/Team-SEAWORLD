<div id="fb-root"></div>
<footer class="container">
    <div class="well animated fadeInUpBig">
        <div class="row">
            <div class="col-md-6">
                <p>Copyright &copy; 2014 Programators</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <!--Google+ plug-in container-->
                    <div class="col-md-12">
                        <div class="g-plusone" data-annotation="inline" data-width="300"></div>
                    </div>

                    <!--Facebook plug-in container-->
                    <div class="col-md-12">
                        <div class="fb-like" data-href="<?php $_SERVER[ 'REQUEST_URI' ];?>"
                             data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--Google+ plug-in-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!--Facebook plug-in-->
<script src="js/facebook.js"></script>

<!--Bootstrap-->
<script src="js/lib/bootstrap.min.js"></script>

<!-- Modals handlers -->
<script src="js/modal.js"></script>
<script src="js/files-uploader.js"></script>

<!-- Logout button -->
<script>
    $(function() {
        var logoutBtn = $( '#logoutBtn' );
        if (logoutBtn.length) {
            logoutBtn.on( 'click', function() {
                window.location.replace(this.dataset.href);
            });
        }
    });
</script>

<script src="js/buttons-handler.js"></script>
</body>
</html>