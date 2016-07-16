<!-- Header -->
<html>
<?php
define('TITLE', 'Sign In');
include 'templates/header.php';

// if user already logged in, redirect to home page
if(isset($_SESSION['logged_in'])) {
    redirect('index.php');
}

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($q = $mysqli->prepare("SELECT id, name, password FROM users WHERE email = ? LIMIT 1")) {
        $q->bind_param('s', $email); // bind email to first question mark

        $q->execute();    // Execute the prepared query.

        $q->store_result();

        // get variables from result.
        $q->bind_result($user_id, $username, $db_password);
        $q->fetch();

        if ($q->num_rows == 1) {

            $hashed_password = sha1($password);

                if ($hashed_password == $db_password) {
                    // Password is correct!

                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);

                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;

                    // Login successful, redirect to index
                    redirect('index.php');

                } else {
                    $error = "Error, password incorrect";
                }

        } else {
            // No user exists.
            $error = "Error email is not found";
        }

    }
}
?>

<body>


<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Sign in to continue</strong>
                </div>
                <div class="panel-body">
                    <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                        }
                    ?>

                    <form role="form" action="./signin.php" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="center-block">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-envelope"></i>
												</span>
                                            <input class="form-control" placeholder="Email Address" name="email" type="text" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
                                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="signin" class="btn btn-lg btn-primary btn-block" value="Sign in">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer ">
                    Don't have an account! <a href="signup.php" onClick=""> Sign Up Here </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<?php
include 'templates/footer.php';
?>
</html>
