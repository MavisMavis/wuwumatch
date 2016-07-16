<!-- Header -->
<html>
<?php
define('TITLE', 'Add a Dog');
include 'templates/header.php';

if (!isset($_SESSION['logged_in'])) {
    redirect('signin.php');
}
?>

<body>
<!-- Navigation bar -->
<?php
include 'templates/menu.php';
?>

<!-- Page Content -->
<div class="container">

</div>

<?php
include 'templates/footer.php';
?>
</html>