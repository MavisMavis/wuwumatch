<!-- Header -->
<html>
<?php
    define('TITLE', 'Home Page');
    include 'templates/header.php';
?>

<body>
<!-- Navigation bar -->
<?php
include 'templates/menu.php';
?>

<!-- Page Content -->
<div class="container">
    <!-- Header -->

    <header class="jumbotron hero-spacer clearfix " id="mainHeader">
        <p>
        <h1 class="text-center"><strong>I Need a partner!</strong></h1>
        </p>

    <div class="input-group">
        <input type="text" class="form-control" placeholder="Find the Dog  ..."/>

        <div class="input-group-btn">
            <button class="btn btn-info" style="padding: 9px">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>

    </div>
    </header>

    <!-- Looking for Companion -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Looking for a Companion</h3>
        </div>
    </div>
    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="image/akita.jpg" alt="">
                <div class="caption">
                    <h3>Akita</h3>
                    <p>The Akita is a large and powerful dog breed with a noble and intimidating presence. He was originally used for guarding royalty and nobility in feudal Japan.
                        The Akita also tracked and hunted wild boar, black bear, and sometimes deer.
                        He is a fearless and loyal guardian of his family. The Akita does not back down from challenges and does not frighten easily.
                        Yet he is also an affectionate, respectful, and amusing dog when properly trained and socialized.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Choose Me!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="image/golden.jpg" alt="">
                <div class="caption">
                    <h3>Golden Retriever</h3>
                    <p>The Golden Retriever is one of the most popular dog breeds in the U.S.
                        The breed’s friendly, tolerant attitude makes him a fabulous family pet,
                        and his intelligence makes him a highly capable working dog. Golden Retrievers
                        excel at retrieving game for hunters, tracking, sniffing out drugs,
                        and as therapy and assistance dogs. They’re also natural athletes,
                        and do well in dog sports such as agility and competitive obedience.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Choose Me!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="clearfix visible-sm"></div>
        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="image/great.jpg" alt="">
                <div class="caption">
                    <h3>Great Pyrenees</h3>
                    <p>The Great Pyrenees dog breed‘s goal in life is to protect sheep, goats, livestock,
                        people, children, grass, flowers, the moon, the lawn furniture, bird feeders,
                        and any real or imaginary predators that may intrude on your personal space.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Choose Me!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="image/siberian.jpg" alt="">
                <div class="caption">
                    <h3>Siberian Husky</h3>
                    <p>The Siberian Husky is a beautiful dog breed with a thick coat that comes in a multitude
                        of colors and markings. Their blue or multi-colored eyes and striking facial masks
                        only add to the appeal of this breed, which originated in Siberia.
                        It is easy to see why many are drawn to the Siberian’s wolf-like looks,
                        but be aware that this athletic, intelligent dog can be independent and
                        challenging for first-time dog owners.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Choose Me!</a> <a href="#" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->




</div>
</body>

<?php
    include 'templates/footer.php';
?>
</html>