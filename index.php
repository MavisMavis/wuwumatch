<!-- Header -->
<html>
<?php
    define('TITLE', 'Home Page');
    include 'templates/header.php';



$q = $mysqli->query("SELECT d.*, u.name AS owner_name, u.id AS owner_id, b.name AS breed_name
                      FROM `dogs` AS d, `users` AS u, `breeds` AS b 
                      WHERE d.owner_id = u.id AND d.breed_id = b.id
                      ORDER BY datetime_added DESC LIMIT 4");

$dogs = [];
while($row = $q->fetch_array(MYSQLI_ASSOC)) {
    $dog_id = $row['id'];
    $row['dog_photos'] = [];
    $dog_photos_q = $mysqli->query("SELECT location FROM dog_photos WHERE dog_id = '$dog_id' LIMIT 1"); // only take 1

    while($photos_row = $dog_photos_q->fetch_array(MYSQLI_ASSOC)) {
        $row['dog_photos'][] = $photos_row['location'];
    }

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
    <!-- Header -->

    <div class="jumbotron hero-spacer clearfix " id="mainHeader">
        <p>
        <h1 class="text-center"><strong>Dog Matching site!</strong></h1>
        </p>

        <div class="col-md-12" style="padding:10px;background:rgba(0,0,0,0.5)">
            <div class="col-md-4 text-center">
                <h3><i class="glyphicon glyphicon-plus"></i> Add Your Dog</h3>
                <p>Add your dog to our ever growing dog listing</p>
            </div>
            <div class="col-md-4 text-center">
                <h3><i class="glyphicon glyphicon-search"></i> Find a Match</h3>
                <p>Our system will automatically matchmake your dog based on gender and breed</p>
            </div>
            <div class="col-md-4 text-center">
                <h3><i class="glyphicon glyphicon-heart"></i> Love</h3>
                <p>Get in touch with the matched dog owner and breed your dogs</p>
            </div>
        </div>

    </div>

    <!-- Looking for Companion -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Looking for a Companion</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php
            foreach($dogs as $dog) {
                ?>
                <div class="col-md-3 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <?php
                        echo '<a href="dogview.php?id='.$dog['id'].'" style="float:left;margin:10px;">';
                        if (!empty($dog['dog_photos'])) {
                            //has dog photos
                            echo '<img src="uploads/'.$dog['dog_photos'][0].'" ></a>';
                        } else {
                            // no dog image, show a default photo
                            echo '<img src="image/default.png"></a>';
                        }
                        ?>
                        <div class="caption">
                            <h3><a href="dogview.php?id=<?php echo $dog['id'] ?>"><?php echo $dog['name'] ?></a></h3>
                            <p><?php echo $dog['description'] ?></p>
                            <p>
                                <a href="dogview.php?id=<?php echo $dog['id'] ?>" class="btn btn-primary">More Info</a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
    </div>



    </div>
    <!-- /.row -->




</div>
</body>

<?php
    include 'templates/footer.php';
?>
</html>