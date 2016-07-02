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
<!--
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Welcome to WUWU MATCH
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
    -->
<!-- Page Content -->
<div class="container">
    <!-- Header -->
    <header class="jumbotron hero-spacer clearfix" id="mainHeader">

        <h1>Welcome! </h1>
        <p>We aim to help the breeders to find the right match for their 'best-friends'</p>

    <div class="input-group">
        <input type="text" class="form-control" placeholder="Find a Breed ..."/>

        <div class="input-group-btn">
            <button class="btn btn-info" style="padding: 9px">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>

    </div>


        
    </header>
</div>
</body>

<?php
    include 'templates/footer.php';
?>
</html>