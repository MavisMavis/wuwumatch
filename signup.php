<!-- Header -->
<html>
<?php
define('TITLE', 'Registration');
include 'templates/header.php';

if (isset($_SESSION['logged_in'])) {
    redirect('index.php');
}

if (isset($_POST['submit'])) {
    //validation
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['gender']) && !empty($_POST['confirm_password'])
        && !empty($_POST['contact_no']) && !empty($_POST['email'])) {

        // all form filled
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $contact_no = $_POST['contact_no'];
        $gender = $_POST['gender'];

        // check if password matches confirm password
        if ($password == $confirm_password) {
            // password matched

            // check if email is unique
            $q = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
            $q->bind_param('s', $email);
            $q->execute();
            $q->store_result();
            $q->fetch();

            if ($q->num_rows <= 0) {
                // email is not in use yet

                // do insert new user into database
                $q = $mysqli->prepare("INSERT INTO users (name,email,password,contact_no,gender) VALUES (?, ?, ?, ?, ?)");
                $q->bind_param('sssss', $name, $email, sha1($password), $contact_no, $gender);

                $q->execute();

                // check if insert is successful
                if ($q->affected_rows == 1) {
                    // insert successful
                    // get the newly registered user id and name for session data
                    $q = $mysqli->prepare("SELECT id, name FROM users WHERE email = ? LIMIT 1");
                    $q->bind_param('s', $email);
                    $q->execute();

                    $q->store_result();
                    $q->bind_result($user_id, $username);
                    $q->fetch();

                    // check if new user data is obtained from database
                    if ($q->num_rows > 0) {

                        // create the session, so user is directly logged in
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;

                        redirect('index.php');

                    } else {
                        $error = "Unable to get user details";
                    }

                } else {
                    $error = "Failed to create user";
                }

            } else {
                $error = "Email is already in use, please choose another";
            }


        }  else {
            // does not match
            $error = "Password and confirm password does not match";
        }
    } else {
        $error = "Please fill up all fields.";
    }
}
?>

<body>
<!-- Navigation bar -->
<?php
include 'templates/menu.php';
?>

<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <?php
                    if(isset($error)) {
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                ?>
                <form class="form-horizontal" action="signup.php" method="post">
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">Name</label>
                    <div class="col-md-5">
                        <input id="name" name="name" type="text" placeholder="Full Name" class="form-control input-md" required="">
                        <span class="help-block">You will use your name as UserID </span>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="gender">Gender</label>
                    <div class="col-md-4">
                        <select id="gender" name="gender" class="form-control">
                            <option value="Other">Other</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="contact_no">Handphone Number</label>
                    <div class="col-md-4">
                        <input id="contact_no" name="contact_no" type="text" placeholder="Handphone Number" class="form-control input-md" required="">
                        <span class="help-block">Kindly key in a reachable contact number</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email Address</label>
                    <div class="col-md-4">
                        <input id="email" name="email" type="text" placeholder="Email Address" class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Password</label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirm_password">Confirm Password</label>
                    <div class="col-md-4">
                        <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password" class="form-control input-md" required="">

                    </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>

                </form>
            </div>
        </div>

</div>

</body>
<?php
include 'templates/footer.php';
?>
</html>
