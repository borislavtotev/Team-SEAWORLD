<div id="fb-root"></div>
<footer class="container">
    <div class="row well">
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
                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/"
                         data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
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

<!-- Auto show error modal window -->
<script type="text/javascript">
    $(function(){
        var errorModal = $( '#errorModal' );
        if (errorModal.length) {
            errorModal.modal( 'show' );
        }
    });
</script>
</body>
</html>