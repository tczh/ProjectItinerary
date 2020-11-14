<?php
session_start();
// var_dump($_SESSION["email"]);
// var_dump($_SESSION["userid"]);
spl_autoload_register(
    function ($class) {
        require_once "objects/model/$class.php";
    }
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="create_itinerary.css">

    <title>Tim's Travel Agent | About</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .motto {
            font-style: italic;
            font-size: 15px;
            margin-left: 5px;
        }

        .navbar {
            /* background-color: #333; */
            /* color: white; */
            /* display: flex; */
            /* top: 0px; */
            /* opacity: 0.8; */
            position: fixed;
            top: 0px;
        }

        .navbar-nav {
            /* color: white; */
            /* padding: 5px; */
            /* border: 5px; */
            /* margin: 10px; */
            /* opacity: 1; */
            /* font-weight: 400; */
        }

        .navbar.top {
            background: transparent;
        }

        .navbar-nav a:hover {
            border-bottom: #f0ad4e 2px solid;
        }

        /* .nav-item {
            margin-right: 20px;
        } */

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

        /* About Info */
        #about-info {
            margin-top: 100px;
        }

        /* #about-info .info-right {
            float: right;
            width: 50%;
            min-height: 100%;
        } */

        /* #about-info .info-right img {
            display: block;
            margin: auto;
            width: 70%;
            border-radius: 50%;
        } */

        #about-info .info-left {
            /* float: left; */
            /* width: 50%; */
            min-height: 100%;
        }


        /* Testimonials */
        #testimonials {
            height: 600px;
            background: url('images/LA.jpg') no-repeat center center/cover;
            padding-top: 100px;
        }

        #testimonials h2 {
            color: #fff;
            text-align: center;
            padding-bottom: 40px;
        }

        #testimonials .testimonial {
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 5px;
            opacity: 0.8;
        }

        #testimonials .testimonial img {
            width: 100px;
            float: left;
            margin-right: 20px;
            border-radius: 50%;
        }

        .testimonial {
            min-height: 140px;
        }

        /* Utility Classes */
        .container {
            margin: auto;
            max-width: 1100px;
            overflow: auto;
            padding: 0 20px;
        }
    </style>
</head>

<body>
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
                    echo "<a class='nav-item nav-link text-white' href='#'>Profile</a>";
                }
                ?>

                <a class='nav-item nav-link text-white' href=#>Cart</a>

                <?php
                if (isset($_SESSION["userid"])) {
                    echo "<a class='nav-item nav-link text-white' href='objects/ProcessLogout.php'>Log Out</a>";
                }
                ?>
            </div>
        </div>
    </nav>


    <section id="about-info" class="py-3">
        <div class="container">
            <div class="info-left">
                <h1 class="l-heading"><span class="text-warning">About</span> Tim's Travel Agency</h1>
                <p>To allow travellers to be able to upload their past itineraries for different locations. In return, they get a small fee when another person purchases their itineraries. The website would be a one-stop portal for travellers to be able to look through other travellers’ itineraries. This helps them save time having to plan their inteinary. With this solution, it targets travellers who are too busy to plan their itinerary but wishes to go on a free and easy trip.</p>
                <p>People prefer to go on a free and easy trip instead of travelling with a tour agency. Free and easy trips grants them more flexibility allowing them to adjust their trip according to their liking. However, planning for a trip requires a lot of work, from searching for the accommodation to deciding on the attraction to visit. The itineraries plan is often left aside after the trip.
                    Hence, the main purpose of our project is to allow busy travellers to gain access to existing itineraries while not letting itineraries that others planned go to waste.
                </p>
            </div>
        </div>
    </section>

    <div class="clr"></div>

    <section id="testimonials" class="py-3">
        <div class="container">
            <h2 class="text-dark">What Our Customers Say</h2>
            <div class="testimonial bg-warning">
                <img src="images/Timothy.jpg" alt="Tim">
                <h4>Thanks Guan Yin Ma for this dope app!</h4>
            </div>

            <div class="testimonial bg-warning">
                <img src="images/XL.jpg" alt="Tim">
                <h4>With this app, Elvis can better plan his itinerary of leaving home on time!</h4>
            </div>
        </div>
    </section>



    <!--Footer-->
    <footer class="footer" id="main-footer" style="background-color: #023047;color:white;">
        <div class="social">
            <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
            <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
            <a href="#"><i class="fab fa-youtube fa-2x"></i></a>
            <a href="https://www.linkedin.com/in/timothy-chia-a23858100/"><i class="fab fa-linkedin fa-2x"></i></a>
        </div>
        <p>Copyright &copy; 2020 - Tim's Travel Agent</p>
    </footer>
</body>

</html>