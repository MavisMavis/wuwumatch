<!-- Header -->
<html>
<?php
define('TITLE', 'My Dogs');
include 'templates/header.php';

if (!isset($_SESSION['logged_in'])) {
    redirect('signin.php');
}

$owner_id = $_SESSION['user_id'];

$filters = '';

if (isset($_GET['breed'])) {
    $breed = $mysqli->real_escape_string($_GET['breed']);
    $filters .= ' AND d.breed_id = \''.$breed.'\'';
}

$q = $mysqli->query("SELECT d.*, b.name AS breed_name
                      FROM `dogs` AS d, `breeds` AS b 
                      WHERE d.breed_id = b.id
                      AND d.owner_id = '$owner_id'
                      $filters
                      ORDER BY datetime_added DESC ");

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
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                My Dogs

                <select id="breeds" class="pull-right">
                    <?php
                    // Breeds dropdown

                    $breeds = getBreeds($mysqli);

                    $allbreedselected = '';
                    if(!isset($_GET['breed'])) {
                        $allbreedselected = 'selected';
                    }
                    echo '<option value="all" '.$allbreedselected.'>All Breeds</option>';

                    foreach($breeds as $breed) {
                        $selected = '';
                        if ($_GET['breed'] == $breed['id']) {
                            $selected = 'selected';
                        }
                        echo '<option value="'.$breed['id'].'" '.$selected.'>'.$breed['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="panel-body">

                <?php
                if(isset($_SESSION['deleteSuccess'])) {
                    if($_SESSION['deleteSuccess']) {
                        echo '<div class="alert alert-success">Successfully deleted dog</div>';
                    } else {
                        echo '<div class="alert alert-danger">Unable to delete dog, please try again later</div>';
                    }

                    unset($_SESSION['deleteSuccess']);
                }
                ?>

                <?php
                if (empty($dogs)) {
                    // no results
                    echo '<h2>No dogs yet</h2><p><a href="add.php" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add a Dog</a></p>';
                } else {
                    foreach($dogs as $dog) {
                        ?>
                        <div class="well">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <?php
                                    echo '<a href="dogview.php?id='.$dog['id'].'" style="float:left;margin:10px;">';
                                    if (!empty($dog['dog_photos'])) {
                                        //has dog photos
                                        echo '<img class="media-object" src="uploads/'.$dog['dog_photos'][0].'" style="width:150px;height:150px;"></a>';
                                    } else {
                                        // no dog image, show a default photo
                                        echo '<img class="media-object" src="image/default.png"></a>';
                                    }
                                    ?>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="dogview.php?id=<?php echo $dog['id'] ?>">
                                            <?php echo $dog['name'] ?>
                                        </a>
                                    </h4>
                                    <p><?php echo $dog['description'] ?></p>
                                    <ul class="list-inline list-unstyled">
                                        <li><span>Breed: <?php echo $dog['breed_name'] ?></span></li>
                                        <li>|</li>
                                        <li><span>Age: <?php echo $dog['age'] ?></span></li>
                                        <li>|</li>
                                        <li><span>Gender: <?php echo $dog['gender'] ?></span></li>
                                    </ul>
                                    <p><i class="glyphicon glyphicon-time"></i> <?php echo timeago($dog['datetime_added']) ?></p>

                                    <?php
                                    $matches = getMatches($mysqli, $dog['breed_id'], $dog['id'], $dog['gender']);
                                    if (empty($matches)) {
                                        echo '<p>No match found yet!</p>';
                                    } else {
                                        echo '<h4>Matched with: </h4>';
                                        foreach ($matches as $matchDog) {
                                            ?>
                                                <p>
                                                 <a href="dogview.php?id=<?php echo $matchDog['id'] ?>">
                                                    <img width="45" src="uploads/<?php echo $matchDog['dog_photos'][0] ?>"> <?php echo $matchDog['name'] ?>
                                                 </a>
                                                </p>
                                            <?php
                                        }
                                    }
                                    ?>

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

<?php include "templates/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('#breeds').on('change', function() {
            var chosen_breed = $('#breeds option:selected').val();
            if ( chosen_breed == 'all') {
                window.location.href= 'mydogs.php';
            } else {
                window.location.href = 'mydogs.php?breed=' + chosen_breed;
            }
        });
    });
</script>

</body>