<body>
<!--Facebook plug-in-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!--End of Facebook plug-in-->
<footer class="container">
    <div class="row">
        <div class="col-md-8">Copyright 2014 Programators</div>
        <div class="col-md-4">
            <div class="g-plusone" data-annotation="inline" data-width="300"></div>
            <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/"
                 data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="js/lib/bootstrap.min.js"></script>
<!--Facebook script-->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : 'your-app-id',
            xfbml      : true,
            version    : 'v2.1'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!--End of Facebook script-->
</body>
</html>