<!-- Header -->
<html>
<?php
define('TITLE', 'All Dogs');
include 'templates/header.php';

if (!isset($_SESSION['logged_in'])) {
    redirect('signin.php');
}

$dog_id = $mysqli->escape_string($_GET['id']); // dogview.php?id=dogid


$q = $mysqli->query("SELECT d.*, u.name AS owner_name, u.id AS owner_id, b.name AS breed_name FROM `dogs` AS d, `users` AS u, `breeds` AS b WHERE d.owner_id = u.id AND d.breed_id = b.id AND d.id = '$dog_id' LIMIT 1");

$dog = $q->fetch_array(MYSQLI_ASSOC); // fetch one item only, no need loop
?>
<body>
<!-- Navigation bar -->
<?php
include 'templates/menu.php';
?>
    <div class="container">
        <div class="co-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dog Info
                </div>
                <div class="panel-body">
                    <?php
                    if (empty($dog)) {
                        echo '<h2>Dog not found! <a href="index.php">Return home</a></h2>';
                    } else {
                        ?>
                        <h2><?php echo $dog['name'] ?></h2>

                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>


</body>