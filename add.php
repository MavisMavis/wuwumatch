<!-- Header -->
<html>
<?php
define('TITLE', 'Add a Dog');
include 'templates/header.php';

if (!isset($_SESSION['logged_in'])) {
    redirect('signin.php');
}

// get breeds
$breeds = getBreeds($mysqli);

if (isset($_POST['submit'])) {


    if (!empty($_POST['dogname']) && !empty($_POST['dogage']) && !empty($_POST['gender']) && !empty($_POST['breeds']) && !empty($_POST['optPure']) && !empty($_POST['dogdesc']) && !empty($_POST['dogmed'])) {


        $name = $_POST['dogname'];
        $age = $_POST['dogage'];
        $gender = $_POST['gender'];
        $breed = $_POST['breeds'];
        $optpure = ($_POST['optPure'] == 'pure')? 1 : 0;
        $desc = $_POST['dogdesc'];
        $med = $_POST['dogmed'];

        // insert into db
        $q = $mysqli->prepare("INSERT INTO dogs(name, breed_id, breed_type, gender, age, description, medical_desc, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $q->bind_param('sssssssd', $name, $breed, $optpure, $gender, $age, $desc, $med, $_SESSION['user_id']);
        $q->execute();



        if($q->affected_rows == 1) {

            $new_insert_dog_id = $q->insert_id;

            // if user has uploaded dog photos
            if(isset($_POST['dogphotos'])) {
                $photos = $_POST['dogphotos']; // array of dog image links uploaded by ajax

                // since theres a lot dog photos, we add one by one
                foreach($photos as $photo) {
                    $photo_q = $mysqli->prepare("INSERT INTO dog_photos(location, dog_id) VALUES(?, ?)");
                    $photo_q->bind_param('sd', $photo, $new_insert_dog_id);
                    $photo_q->execute();
                }

            }
            // successfully inserted
            $success = 'Succesfully added your dog, <a href="dogview.php?id='.$new_insert_dog_id.'">Click here to see your dog here</a>';
        } else {
            $error = 'Unable to add your dog, try again later';
        }

    } else {
        $error = "Please fill up all fields";
    }
}
?>

<body>
<!-- Navigation bar -->
<?php
include 'templates/menu.php';
?>

<!-- Page Content -->
<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Your Dog
            </div>
            <div class="panel-body">
                <?php
                    if (isset($error)) {
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }

                    if (isset($success)) {
                        echo '<div class="alert alert-success">'.$success.'</div>';
                    }


                ?>
                <div class="col-md-12">
                    <div id="uploadImages" class="clearfix"></div>

                    <form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="handle_upload.php">
                        <input type="hidden" name="image_form_submit" value="1"/>
                        <label>Choose Image</label>
                        <input type="file" name="images[]" id="images" multiple >
                        <div class="uploading hidden">
                            <p>Uploading...</p>
                        </div>
                    </form>

                    <form class="form-horizontal" id="addDogForm" action="add.php" method="post">

                        <div class="form-group">
                            <label for="dogname" class="control-label">Dog Name</label>
                            <input type="text" id="dogname" name="dogname" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="dogage" class="control-label">Dog Age</label>
                            <input type="number" id="dogage" name="dogage"  class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label>Dog Breed</label>
                            <select id="breeds" name="breeds" class="form-control">
                                <?php
                                    foreach ($breeds as $breed)
                                    {
                                        echo '<option value="'.$breed['id'].'">'.$breed['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optPure" id="pure" value="pure" checked>
                                    Pure Breed
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optPure" id="mixed" value="mixed">
                                    Mixed Breed
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dogdesc" class="control-label">Dog Description</label>
                            <textarea name="dogdesc" id="dogdesc" placeholder="Eg. A fun and loving dog"  class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="dogmed" class="control-label">Dog Medical Info</label>
                            <textarea name="dogmed" id="dogmed" placeholder="Eg. Done all required vaccination, very healthy" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success" value="Add Dog"/>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
include 'templates/footer.php';
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#images').on('change',function(){
            $('#multiple_upload_form').ajaxForm({
                //display the uploaded images
                target:'#images_preview',
                dataType: 'json',
                beforeSubmit:function(e){
                    $('.uploading').removeClass('hidden');
                },
                success:function(data){
                    $('.uploading').addClass('hidden');

                    /// add each uploaded image to preview
                    $.each(data, function(index, imagelink) {
                        console.log(imagelink);

                        //this add a hidden input to the form with name dogphotos[] which is an array
                        $('#addDogForm').append('<input type="hidden" name="dogphotos['+ index +']" value="'+ imagelink +'"/>');

                        $('#uploadImages').append(
                            '<img src="uploads/'+ imagelink +'" class="image">'
                        )
                    });
                },
                error:function(e){
                }
            }).submit();
        });
    });
</script>
</html>