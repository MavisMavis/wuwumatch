<!-- Header -->
<html>
<?php
define('TITLE', 'Contact us');
include 'templates/header.php';
?>

<body>
<?php
include 'templates/menu.php';
?>


<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Blog
                <small>Cross Breaded Puppies Need Homes</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a>
                </li>
                <li class="active">Stories</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Blog Post Row -->
    <div class="row">
        <div class="col-md-1 text-center">
            <p><i class="fa fa-camera fa-4x"></i>
            </p>
            <p></p>
        </div>
        <div class="col-md-5">
            <a href="blog-post.html">
                <img class="img-responsive img-hover" src="image/pic_blog_1.jpg" alt="">
            </a>
        </div>
        <div class="col-md-6">
            <h3>
                <a href="blog-post.html">Elsie – 4 month old female Cross-Breed</a>
            </h3>
            <p>by <a href="#">Mavis</a> <!--post by admin  -->
            </p>
            <p>Elsie is a 4 month old female Cross-Breed. This beautiful sweet little girl is Elsie, she is one of the farm pups and is fully vaccinated and ready to travel. Elsie we estimate will be medium when fully grown. She needs a family of her own now.</p>
            <a class="btn btn-primary" href="blog-post.html">Adopt me  <i class="fa fa-paw"></i></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Blog Post Row -->
    <div class="row">
        <div class="col-md-1 text-center">
            <p><i class="fa fa-film fa-4x"></i>
            </p>
            <p>June 17, 2014</p>
        </div>
        <div class="col-md-5">
            <a href="blog-post.html">
                <img class="img-responsive img-hover" src="image/pic_blog_2.jpg" alt="">
            </a>
        </div>
        <div class="col-md-6">
            <h3><a href="blog-post.html">Dylan – 9 week old male German Shepherd cross Lurcher</a>
            </h3>
            <p>by <a href="#">Mavis</a>
            </p>
            <p>Dylan is around 9 weeks old now and is a German Shepherd cross Lurcher type puppy. He is a typical puppy and will need training in all areas. His new owners will have to be prepared to put in the work with him so he grows into a well socialised (large breed) adult. Dylan loves humans and would prefer that they are around for most of the day so that they can train and socialise him. He is has a tendency to guard around his food so we recommend that any children in the house are teens and up. At the moment he is being hand fed in his foster home to try to get over this behaviour. We recommend that this is continued in his new home.</p>
            <a class="btn btn-primary" href="blog-post.html">Adopt Me  <i class="fa fa-paw"></i></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Blog Post Row -->
    <div class="row">
        <div class="col-md-1 text-center">
            <p><i class="fa fa-file-text fa-4x"></i>
            </p>
            <p>June 17, 2014</p>
        </div>
        <div class="col-md-5">
            <a href="blog-post.html">
                <img class="img-responsive img-hover" src="image/pic_blog_3.jpg" alt="">
            </a>
        </div>
        <div class="col-md-6">
            <h3><a href="blog-post.html">Adina – 3-4 month old female Cross-Breed</a>
            </h3>
            <p>by <a href="#">Mavis</a>
            </p>
            <p>This beautiful bundle is Adina and her and her siblings who were found along side their dead mum are now looking for homes of their own. Adina is just the cutest little pup, she is playful and a typical little pup.</p>
            <a class="btn btn-primary" href="blog-post.html">Read More <i class="fa fa-paw"></i></a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Pager -->
    <div class="row">
        <ul class="pager">
            <li class="previous"><a href="#">&larr; Older</a>
            </li>
            <li class="next"><a href="#">Newer &rarr;</a>
            </li>
        </ul>
    </div>
    <!-- /.row -->

    <hr>

</div>


</body>
<?php
include 'templates/footer.php';
?>

<script>
    $('.row').hide();
    $(document).ready(function() {
        $(".row").each(function(index) {
            $(this).delay(300*index).fadeIn(400);
        });
    });
</script>
</html>
