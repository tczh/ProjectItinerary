<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./itinerarydetails.css">
    <style>
        .nav-link{
            color:black;
        }
        body{
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
        if ( !isset($_SESSION["email"]) || !isset($_GET["itineraryid"]) || (!isset($_GET["userid"]) && !isset($_GET["itineraryowner"])  ) ) {
       
            // redirect to login page
            header("Location: index.html"); 
        
            // stop all further execution 
            // (if there are statements below)
            exit;
        }
    ?>

    <div id ="userid" style="display:none;">
        <?php
            if(isset($_GET["userid"])){
                echo $_GET["userid"];
            }
            if(isset($_GET["itineraryowner"])){
                echo $_GET["itineraryowner"];
            }
            
        ?>
    </div>

    <div id ="check" style="display:none;">
        <?php
            if(isset($_GET["userid"])){
                echo "1";
            }
            if(isset($_GET["itineraryowner"])){
                echo "2";
            }
            
        ?>
    </div>

    <div id ="itineraryid" style="display:none;">
        <?php
            echo $_GET["itineraryid"];
        ?>
    </div>
    <div class = "container">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>