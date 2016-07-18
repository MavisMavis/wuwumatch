<!-- Header -->
<html>
<?php
define('TITLE', 'All Dogs');
include 'templates/header.php';

if (!isset($_SESSION['logged_in'])) {
    redirect('signin.php');
}

$q = $mysqli->query("SELECT d.*, u.name AS owner_name, u.id AS owner_id, b.name AS breed_name
                      FROM `dogs` AS d, `users` AS u, `breeds` AS b 
                      WHERE d.owner_id = u.id AND d.breed_id = b.id
                      ORDER BY datetime_added DESC ");
$dogs = [];
while($row = $q->fetch_array(MYSQLI_ASSOC)) {
    $dogs[] = $row;
}

?>


<body>
<!-- Navigation bar -->
<?php
include 'templates/menu.php';
?>

<!-- Page Content -->
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Dog List
            </div>
            <div class="panel-body">

                <?php
                    if (empty($dogs)) {
                    // no results
                        echo '<h2>No dogs yet</h2>';
                    } else {
                    foreach($dogs as $dog) {
                        ?>
                        <div class="well">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placekitten.com/150/150">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="dogview.php?id=<?php echo $dog['id'] ?>">
                                            <?php echo $dog['name'] ?>
                                        </a>
                                    </h4>
                                    <p class="text-right"><i class="glyphicon glyphicon-user"></i> <?php echo $dog['owner_name'] ?></p>
                                    <p><?php echo $dog['description'] ?></p>
                                    <ul class="list-inline list-unstyled">
                                        <li><span>Breed: <?php echo $dog['breed_name'] ?></span></li>
                                        <li>|</li>
                                        <li><span>Age: <?php echo $dog['age'] ?></span></li>
                                        <li>|</li>
                                        <li><span>Gender: <?php echo $dog['gender'] ?></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!--item-->
                        <?php
                    } // for each
                    } // end of else
                ?>

            </div>
        </div>
    </div>
</div>


</body>