<nav class="navbar navbar-inverse " role="navigation">
<div class="container" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainMenu" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">WuwuMatch</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="mainMenu">
        <ul class="nav navbar-nav">


            <li class="dropdown">
                <a href="breed.php" class="dropdown-toggle" data-toggle="dropdown">Dog Breeds<b class="caret"></b> </a>
                <ul class="dropdown-menu">
                    <li><a href="dog-list.php">Dog List</a></li>
                    <li><a href="dogview.php">Dog View</a></li>
                </ul>
            </li>

            <li><a href="blog.php">Blogs</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <?php
            if(!isset($_SESSION['logged_in'])) {
            ?>
                <li><a href="signin.php"><i class="glyphicon glyphicon-log-in"></i> Sign In</a></li>
                <li><a href="signup.php"><i class="glyphicon glyphicon-plus"></i> Sign Up</a></li>

            <?php
            } else {
                ?>
                <li><a href="add.php"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add Dog</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i
                            class="glyphicon glyphicon-user"></i>
                        <?php if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        } ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Settings</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </li>

                <?php
            }
            ?>
        </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>