<?php
$currentPage = $_SERVER[ 'REQUEST_URI' ];
?>
<div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="Login Register" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="loginRegisterLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="loginRegisterForm" class="form-horizontal" action="" method="post">
                    <input type="hidden" name="redirectTo" value="<?=$currentPage?>">
                    <div class="form-group">
                        <label for="inputUserName" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="username" class="form-control" id="inputUserName" placeholder="Username">
                        </div>
                    </div>
                    <div id="emailInputContainer" class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                            <div id="rememberMeCheck" class="checkbox">
                                <label>
                                    <input name="rememberMe" type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button id="submitBtn" type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>