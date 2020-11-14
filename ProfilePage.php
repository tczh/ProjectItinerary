<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous"/>
    
    <style>
        .nav-link{
            color:black;
        }
        div.stars{
            display:inline-block;
            top:50%;
            left:50%;
        }
        input.star{
            display:none;
        }
        label.star{
            float:right;
            padding:0px 10px;
            color: black;

        }
        input.star:checked ~label.star:before{
            content:"\f005";
            color: yellow;
            border:black 1px;
    
        }
        input .star-5:checked ~ label.star:before {
            color: "#1abc9c";
            text-shadow: 0 0 15px #1abc9c;
        }
        input .star-1:checked ~ label.star:before{
            color: "yellow";
            border:black 1px;
        }

        label.star:before{
            content:'\f006';
            font-family: FontAwesome;
        }
        
        .navbar-nav a:hover {
            border-bottom: #f0ad4e 2px solid;
        }

        .nav-item {
            margin-right: 20px;
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

        .footer .social > * {
            margin-left: 15px;
            margin-right: 15px;
        }

        .bg-dark {
            background: #333;
            color: #fff;
        }
    </style>
    <script src="profile.js"></script>
</head>
<body onload="onLoadData()">
    <?php
        session_start();
        
        if ( !isset($_SESSION["email"]) ) {
       
            // redirect to login page
            header("Location: index.html"); 
        
            // stop all further execution 
            // (if there are statements below)
            exit;
        }
        function Redirect(){
            print("Here");

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
                }
                else {
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
    <div id ="userid2" style="display:none;">
        <?php
            echo $_SESSION["userid"];
        ?>
    </div>
    <div id ="emailstorage" style="display:none;">
    </div>
    <div class = "container" style="margin-top:80px">
        <div class="row">
            <div class="col-sm-4 text-center">
                <!--Tabs -->
                <h5>My Account</h5>
                <hr>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Account Information </a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">View All Itineraries</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" onClick="Redirect()">View All Feedbacks</a>
                    
                </div>
            </div>   
            <div class="col-sm-8 text-center">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="container-fluid text-center bg-dark rounded p-2">
                        <h2 style="color:white">Personal Details</h1>
                    </div>
                    <div id="error1" class="alert alert-danger" role="alert">
                    </div>
                    <div class="container collapse show" id="accountInfo"></div>
                    <div id="changePw" class="container-fluid pl-0 pr-0">
                        <div class="container-fluid text-center bg-dark rounded p-2 mt-4">
                            <h2 style="color:white">Password</h1>
                        </div>
                        <div id="error2" class="alert alert-danger" role="alert">
                        </div>
                        <div class="container collapse show" id="passwordInfo" ></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="container-fluid text-center bg-dark rounded p-2">
                        <h2 style="color:white">Itineraries</h1>
                    </div>
                    <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Purchased Itineraries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Created Itineraries</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active mb-4 mt-0" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" id="purchasedItinerary"></div>
                        <div class="tab-pane fade mb-4" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" id="SwapResults">
                    <div class="container-fluid text-center bg-dark rounded p-2">
                        <h2 style="color:white">All Reviews</h2>
                    </div>
                    <a href="NewReview.html"></a>
                    <div id='arrayList'>
                    
                    </div>
                    <div id='insertion'></div>
                </div>
            
                </div>
            </div>
        </div>
    </div>    
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

</body>
</html>