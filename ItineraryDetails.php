<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./itinerarydetails.css">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous"/>

    <link rel="stylesheet" href="create_itinerary.css">

    <style>
        .nav-link {
            color: black;
        }

        body {
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: bottom;
        }
    </style>
    <script src="itinerarydetails.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>

<body onload="onLoadData()">
    <?php
    session_start();
    if (!isset($_SESSION["email"]) || !isset($_GET["itineraryid"]) || (!isset($_GET["userid"]) && !isset($_GET["itineraryowner"]))) {

        // redirect to login page
        header("Location: index.html");

        // stop all further execution 
        // (if there are statements below)
        exit;
    }
    ?>




    <nav id="navbar" class="navbar top fixed-top navbar-dark navbar-expand-sm" style="background-color: #023047;">
        <!-- Navbar content -->
        <a class="navbar-brand" href="index.php">
            <span class="text-warning"><i class="fas fa-globe-americas fa-2x"></i></span>
            <span class="text-warning">Tim's</span> Travel Agent
            <!-- <small>Where your itineraries come to life</small> -->
            <!-- <em class="motto">Where your itineraries come to life</em> -->
        </a>

        <button class='navbar-toggler' data-toggle='collapse' data-target='#myMenu'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="myMenu">
            <div class='navbar-nav'>
                <!-- Need to update href links when they are ready-->
                <a class='nav-item nav-link text-white' href=index.php>Home</a>
                <a class='nav-item nav-link text-white' href=about.php>About</a>
                <?php
                if (!isset($_SESSION["userid"])) {
                    echo "<a class='nav-item nav-link text-white' href='login.php'>Login</a>";
                } else {
                    echo "<a class='nav-item nav-link text-white' href='ProfilePage.php'>Profile</a>";
                    echo "<a class='nav-item nav-link text-white' href='create_itinerary.html'>Create Itinerary</a>";
                }
                ?>
                <a class='nav-item nav-link text-white' href='checkout.html'>Cart</a>

                <?php
                if (isset($_SESSION["userid"])) {
                    echo "<a class='nav-item nav-link text-white' href='objects/ProcessLogout.php'>Log Out</a>";
                }
                ?>

            </div>
        </div>
    </nav>

    <div id="userid" style="display:none;">
        <?php
        if (isset($_GET["userid"])) {
            echo $_GET["userid"];
        }
        if (isset($_GET["itineraryowner"])) {
            echo $_GET["itineraryowner"];
        }

        ?>
    </div>

    <div id="check" style="display:none;">
        <?php
        if (isset($_GET["userid"])) {
            echo "1";
        }
        if (isset($_GET["itineraryowner"])) {
            echo "2";
        }

        ?>
    </div>

    <div id="itineraryid" style="display:none;">
        <?php
        echo $_GET["itineraryid"];
        ?>
    </div>
    <!-- <br><br><br><br><br><br><br> -->
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-sm-12 text-center" id="headerimg" style="height:200px;background:white; opacity:90%">
            </div>
            <img>
            <div class="col-sm-12 text-center" id="headertext" style="background:white;opacity: 90%"></div>

            <div class="col-sm-3 text-center mt-5" id="overview">

            </div>
            <div class="col-sm-9 text-center mt-5" id="content">
            </div>
        </div>
    </div>

    <br><br><br>

    <div id="insert_modal"></div>

    <footer class="footer" style="background-color: #023047; color:white">
        <div class="social">
            <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
            <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
            <a href="#"><i class="fab fa-youtube fa-2x"></i></a>
            <a href="https://www.linkedin.com/in/timothy-chia-a23858100/"><i class="fab fa-linkedin fa-2x"></i></a>
        </div>
        <p>Copyright &copy; 2020 - Tim's Travel Agent</p>
    </footer>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    

    <style>
        .navbar-nav a:hover {
            border-bottom: #f0ad4e 2px solid;
        }

        /* Footer */
        .footer {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 200px;
        }

        .footer a {
            color: #fff;
        }

        .footer a:hover {
            color: #f0ad4e;
        }

        .footer .social>* {
            margin-left: 15px;
            margin-right: 15px;
        }

        .bg-dark {
            background: #333;
            color: #fff;
        }
    </style>


</body>

</html>