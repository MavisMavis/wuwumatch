<!-- Header -->
<html>
<?php
define('TITLE', 'Contact us');
include 'templates/header.php';

if (isset($_POST['submit'])) {
    $to      = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = 'From: mavisong11@gmail.com' . "\r\n" .
        'Reply-To: mavisong11@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    $success = 'Successfully sent email';
}
?>

<body>
<?php
include 'templates/menu.php';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <h1 class="h1">
                Contact us <small>Feel free to contact us</small></h1>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row">
        <?php
            if(isset($success)) {
                echo '<div class="alert alert-success">'.$success.'</div>';
            }
        ?>
        <div class="col-md-8">
            <div class="well well-sm">

                <form action="contactus.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email Address</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email" required="required" /></div>
                            </div>
                            <div class="form-group">
                                <label for="subject">
                                    Subject</label>
                                <select id="subject" name="subject" class="form-control" required="required">
                                    <option value="na" selected="">Choose One:</option>
                                    <option value="service">General Enquiry</option>
                                    <option value="suggestions">Suggestions</option>
                                    <option value="product">Website Support Issue</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Message</label>
                                <textarea name="message" id="message" name="message" class="form-control" rows="9" cols="25" required="required"
                                          placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" id="btnContactUs" value="Send" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                <address>
                    <strong>Coventry University </strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">
                        P:</abbr>
                    (123) 456-7890
                </address>
                <address>
                    <strong>Full Name</strong><br>
                    <a href="mailto:#">mavisong11@gmail.com</a>
                </address>
            </form>


    </div>
</div>


</body>
<?php
include 'templates/footer.php';
?>
</html>
