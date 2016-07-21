<!-- Header -->
<html>
<?php
define('TITLE', 'My Settings');
include 'templates/header.php';

if (!isset($_SESSION['logged_in'])) {
    redirect('signin.php');
}

$user_id = $_SESSION['user_id'];
$q = $mysqli->query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
$user_setting = $q->fetch_array(MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    //validation
    if (!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['contact_no']) && !empty($_POST['email'])) {

        // all form filled
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $contact_no = $_POST['contact_no'];
        $gender = $_POST['gender'];

        // check if password matches confirm password

            // check if email is unique
            $q = $mysqli->prepare("SELECT email FROM users WHERE email = ? AND id != ?");
            $q->bind_param('sd', $email, $user_id);
            $q->execute();
            $q->store_result();
            $q->fetch();

            if ($q->num_rows <= 0) {
                // email is not in use yet

                if (!empty($password)) {
                    // user has inputted new password, user wants to update password
                    if ($password == $confirm_password) {

                        // do insert new user into database
                        $q = $mysqli->prepare("UPDATE users SET name = ? , email = ? ,password = ? ,contact_no = ?, gender = ? WHERE id = ?");
                        $q->bind_param('sssss', $name, $email, sha1($password), $contact_no, $gender, $_SESSION['user_id']);

                    } else {
                        $error = 'Password and confirm password does not match';
                    }
                } else {
                    // user not updating password
                    // do insert new user into database
                    $q = $mysqli->prepare("UPDATE users SET name = ? , email = ? ,contact_no = ?, gender = ? WHERE id = ?");
                    $q->bind_param('sssss', $name, $email, $contact_no, $gender, $_SESSION['user_id']);
                }

                $q->execute();

                // check if update is successful
                if ($q->affected_rows == 1) {
                    // update successful
                        $success = "Successfully updated";
                        $_SESSION['username'] = $name;

                } else {
                    $error = "Failed to create user";
                }

            } else {
                $error = "Email is already in use, please choose another";
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
        <div class="panel-heading">Settings</div>
        <div class="panel-body">
            <?php
            if(isset($error)) {
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            if (isset($success)) {
                echo '<div class="alert alert-success">'.$success.'</div>';
            }
            ?>
            <form class="form-horizontal" action="settings.php" method="post">
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="name">Name</label>
                    <div class="col-md-5">
                        <input id="name" value="<?php echo $user_setting['name'] ?>" name="name" type="text" placeholder="Full Name" class="form-control input-md" required="">
                        <span class="help-block">You will use your name as UserID </span>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="gender">Gender</label>
                    <div class="col-md-4">
                        <select id="gender" name="gender" class="form-control">
                            <option value="Other" <?php  echo ($user_setting['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                            <option value="Male" <?php  echo ($user_setting['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?php  echo ($user_setting['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                </div>


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="contact_no">Handphone Number</label>
                    <div class="col-md-4">
                        <input id="contact_no" name="contact_no"  value="<?php echo $user_setting['contact_no'] ?>" type="text" placeholder="Handphone Number" class="form-control input-md" required="">
                        <span class="help-block">Kindly key in a reachable contact number</span>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email Address</label>
                    <div class="col-md-4">
                        <input id="email" name="email" value="<?php echo $user_setting['email'] ?>" type="text" placeholder="Email Address" class="form-control input-md" required="">

                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Password</label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md"/>

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="confirm_password">Confirm Password</label>
                    <div class="col-md-4">
                        <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password" class="form-control input-md"/>

                    </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-default">Save Settings</button>
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
