<html>

<?php
define('TITLE', 'Login Page');
include 'templates/header.php';
?>

<body>
<!-- Navigation Bar -->

<!-- Page Content -->
<div class="container">
    <div id="box_login" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Log In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a>
                </div>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <!-- show any messages that come back with authentication -->
                <div id="div_alert" style="display: none"></div>

                <form id="form_login" class="form-horizontal" role="form" action="/"
                      method="post">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input id="email" type="email" class="form-control" name="email" value=""
                               placeholder="Email Address"/>

                        testestest
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password"
                               placeholder="password"/>
                    </div>

                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="remember_me" type="checkbox" name="remember_me" value="1"> Remember me
                            </label>
                        </div>
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input id="btn_login" type="submit" name="submit"
                                    class="btn btn-success btn-lg btn-block" value="Login"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Don't have an account!
                                <a id="link_signup"href="#" onClick="$('#box_login').hide(); $('#box_signup').show()">
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="box_signup" style="display:none; margin-top:50px"
         class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px">
                    <a id="link_login" href="#" onclick="$('#box_signup').hide(); $('#box_login').show()">Log In
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <form id="form_signup" class="form-horizontal" role="form">

                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>


                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                   placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Last Name</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                   placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>

                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="invitation_code" class="col-md-3 control-label">Invitation Code</label>

                        <div class="col-md-9">
                            <input type="text" class="form-control" id="invitation_code" name="invitation_code"
                                   placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="button" class="btn btn-info btn-lg btn-block"><i
                                    class="icon-hand-right"></i>
                                &nbsp Sign Up
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

</body>

<?php
include 'templates/footer.php';
?>
</html>