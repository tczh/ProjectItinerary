<?php
    session_start();
    // var_dump($_SESSION["email"]);
    // var_dump($_SESSION["userid"]);
    spl_autoload_register(
        function($class){
            require_once "objects/model/$class.php";
        }
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous"/>

    <script src="index.js"></script>

    <title>Welcome To Tim's Travel Agent</title>

    <style>
        * {
               margin: 0;
               /* padding: 0; */
        }

        .motto {
            font-style: italic;
            font-size: 15px;
            margin-left: 5px;
        }

        .hero{
            background-image: url("scenery.jpg");
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 100%;
            /* margin-left: auto;
            margin-right: auto; */
            /* padding-top: 100px;
            padding-bottom: 100px; */
        }
        #searchBar{
            /* border:grey 1px solid; */
            padding:20px;
            border-radius: 20px;
            margin: 150px;
        }

        #searchText{
            /* font-weight: bold; */
            font-size: 30px;
        }

        .navbar {
            /* background-color: #333; */
            /* color: white; */
            /* display: flex; */
            /* top: 0px; */
            opacity: 0.8;
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

        #price-range {
            /* padding: 0.5px; */
        }

        #date-picker {
            margin-bottom: 16px;
        }

        #categories {
            margin-top: 10px;
            text-align: center;
        }

        .categories {
            margin-left:50px;
            margin-right:50px;
            margin-bottom: 10px;
        }

        #cards {
            margin-left: 10%;
            margin-right: 10%;
        }

    </style>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>
<body onload="load()">
    
    <!-- Navbar collapse if width is sm-->
    <header class="hero">
    <nav id="navbar" class="navbar top fixed-top navbar-dark bg-dark navbar-expand-sm">
        <!-- Navbar content -->
        <a class="navbar-brand" href="index.php"><span class="text-warning">Tim's</span> Travel Agent
        <span class="text-warning"><i class="fas fa-globe-americas fa-2x"></i></span><em class="motto">Where your itineraries come to life</em>
        </a>

        <button class='navbar-toggler' data-toggle ='collapse' data-target='#myMenu'>
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
                    echo "<a class='nav-item nav-link text-white' href='ProfilePage.php'>Profile</a>
                    <a class='nav-item nav-link text-white' href='create_itinerary.html'>Create Itinerary</a>";
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


    <!--Itinerary search bar-->
    <div class="container-fluid text-center" id="searchBarImage">
        <div class = "row justify-content-center">
            <div class= "col-4 bg-light" id="searchBar">       
                <label id="searchText" class="">Find your dream itinerary!</label>
                <input id="locationInput" class="form-control mb-3" type="search" placeholder="Enter Your Dreamland (Country)" aria-label="Search">
                
                <!--Days box & Price Range box-->
                <!-- <div class="input-group mb-3 mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Days</span>
                    </div>

                    <input type="text" class="form-control" placeholder="Enter Price Range" aria-label="days" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Price Range</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Price Range" aria-label="price" aria-describedby="basic-addon2">
                </div> -->

                <!-- Price Range -->
                <!-- <div class="form-group">
                    <label for="formControlRange">Price Range</label>
                    <div class="row dual-form" id="price-range">
                        <div class="col-9">
                            <input type="range" class="form-control-range" name="rangeInput" min="0" max="100" onchange="updateTextInput(this.value);">
                        </div>
                        <div class="col-1"></div>
                        <input type="text" class="form-control col-2" id="textInput" value="">
                    </div>
                </div> -->
                
                <!-- <div class="input-group input-daterange">
                    <input type="text" class="form-control" value="2012-04-05">
                    <div class="input-group-addon">to</div>
                    <input type="text" class="form-control" value="2012-04-19">
                </div> -->

                <div class="form-group">
                    <select class="form-control" id="pricerange">
                    <option value='0'>Price Range</option>
                    <option value='1'>Less than $100</option>
                    <option value='2'>$100 - $199.99</option>
                    <option value='3'>$200 - $299.99</option>
                    <option value='4'>$300 - $399.99</option>
                    <option value='5'>$400 - $500</option>
                    <option value='6'>More than $500</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Date Range</span>
                    </div>
                    <input type="text" class="form-control" id="daterange" name="daterange" value="11/11/2020 - 11/30/2020">
                </div>

                <div class="form-group">
                    <select class="form-control" id="season">
                    <option>Season</option>
                    <option>Spring</option>
                    <option>Summer</option>
                    <option>Autumn</option>
                    <option>Winter</option>
                    </select>
                </div>

                <button class="btn btn-warning" type="submit" onclick=filter()>Search</button>
            </div>
        </div>
    </div>
    </header>

    <!-- <div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="images/Australia.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="images/Bangkok.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="images/California.jpg" alt="Third slide">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div> -->
    <div id="categories">
        <!-- <span class="badge badge-pill badge-info">Luxury</span>
        <span class="badge badge-pill badge-info">Budget</span>
        <span class="badge badge-pill badge-info">Nature</span>
        <span class="badge badge-pill badge-info">City</span>
        <span class="badge badge-pill badge-info">Others</span> -->

        <button type="button" class="btn btn-info categories" onclick="filterCategory('luxury')">Luxury</button>
        <button type="button" class="btn btn-info categories" onclick="filterCategory('budget')">Budget</button>
        <button type="button" class="btn btn-info categories" onclick="filterCategory('nature')">Nature</button>
        <button type="button" class="btn btn-info categories" onclick="filterCategory('city')">City</button>
        <button type="button" class="btn btn-info categories" onclick="filterCategory('others')">Others</button>
    </div>
    
    <div id="cards">
    <?php
        $dao = new ItineraryDAO();
        $itineraries = $dao->retrieveAll();

        // echo '
        // <div class="card-columns">';

        foreach ($itineraries as $itinerary) {
            $itineraryid = $itinerary->getItineraryid();
            $itineraryowner = $itinerary->getItineraryowner();
            $tourtitle = $itinerary->getTourtitle();
            $tourcategory = $itinerary->getTourcategory();
            $country = $itinerary->getCountry();
            $price = $itinerary->getPrice();
            $thumbnail = $itinerary->getThumbnail();
            $season = $itinerary->getSeason();

            $itineraryArray[] = [
                "itineraryid" => $itineraryid,
                "itineraryowner" => $itineraryowner,
                "tourtitle" => $tourtitle,
                "tourcategory" => $tourcategory,
                "country" => $country,
                "price" => $price,
                "thumbnail" => $thumbnail,
                "season" => $season
            ];
            
            // echo '
            // <div class="card">
            //     <img class="card-img-top" src="images/';
            //     echo $thumbnail;
            //     echo'" alt="';
            //     echo $tourtitle;
            //     echo '">
            //     <div class="card-body">
            //         <h5 class="card-title">';
            //         echo $tourtitle;
            //         echo '</h5>
            //         <p class="card-text">Price: $';
            //         echo $price;
            //         echo '</p>
            //         <a href="#" class="btn btn-warning">View More</a>
            //     </div>
            // </div>
            // ';
        }
        // echo '</div>
        // ';

        // echo json_encode($itineraryArray);
        // header("Location: objects/ProcessItinerary.php?itineraryid=$itineraryid&itineraryowner=$itineraryowner&tourtitle=$tourtitle&tourcategory=$tourcategory&country=$country&price=$price&thumbnail=$thumbnail&season=$season");
        // header("Location: objects/ProcessItinerary.php?itineraries=$itineraryArray");

        // var_dump($itineraries);
    ?>

    <!-- snip -->
        <!-- <script>
            function reqListener () {
            console.log(this.responseText);
            }

            var oReq = new XMLHttpRequest(); // New request object
            oReq.onload = function() {
                // This is where you handle what to do with the response.
                // The actual data is found on this.responseText
                alert(this.responseText); // Will alert: 42
            };
            oReq.open("get", "get-data.php", true);
            //                               ^ Don't block the rest of the execution.
            //                                 Don't wait until the request finishes to
            //                                 continue.
            oReq.send();
        </script> -->
    <!-- snip -->
    </div>


    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->

    <!--Footer-->
    <footer class="footer bg-dark">
      <div class="social">
        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
        <a href="#"><i class="fab fa-youtube fa-2x"></i></a>
        <a href="https://www.linkedin.com/in/timothy-chia-a23858100/"><i class="fab fa-linkedin fa-2x"></i></a>
      </div>
      <p>Copyright &copy; 2020 - Tim's Travel Agent</p>
    </footer>
    
    <!-- <script>
        const navbar = document.getElementById('navbar');
        let scrolled = false;

        window.onscroll = function () {
            if (window.pageYOffset > 100) {
            navbar.classList.remove('top');
            if (!scrolled) {
                navbar.style.transform = 'translateY(-70px)';
            }
            setTimeout(function () {
                navbar.style.transform = 'translateY(0)';
                scrolled = true;
            }, 200);
            } else {
            navbar.classList.add('top');
            scrolled = false;
            }
        };
    </script> -->

    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqsd6B8t6d8EIDIhtISazAvVufIy07_-U&libraries=places&callback=load"></script>
    <!-- <script src="js/lightbox.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
            opens: 'left'
            }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

<script type="text/javascript">
    var jsItinerary = <?php echo json_encode($itineraryArray); ?>;
    // var obj = JSON.parse(obj);
    console.log(jsItinerary);

    function load() {
        var input = document.getElementById("locationInput");
        var autocomplete = new google.maps.places.Autocomplete(input);

        filter();
    }

    function filter() {
        var country = document.getElementById('locationInput').value;
        var price = document.getElementById('pricerange').value;
        var daterange = document.getElementById('daterange').value;
        var season = document.getElementById('season').value;

        var str = '<div class="card-columns">'
        for (itinerary of jsItinerary) {
            console.log(country);
            console.log(itinerary['country']);
            if (country != '' && country.toLowerCase() != itinerary['country'].toLowerCase()) {
                continue;
            }

            if (season != 'Season' && season.toLowerCase() != itinerary['season'].toLowerCase()) {
                continue;
            }

            console.log(price);
            console.log(itinerary['price']);
            // console.log(priceArray[(0)][0]));

            var priceArray = [[0,99.99], [100, 199.99], [200,299.99], [300,399.99], [400,500], [500, 9999999999]];

            console.log(priceArray[(0)][0]);

            if (price != 0 && ((parseFloat(itinerary['price']) < priceArray[(price-1)][0]) || (parseFloat(itinerary['price']) > priceArray[(price-1)][1]))) {
                continue;
            }
            
            str += '<div class="card">';
            str += '<img class="card-img-top" src="images/' + itinerary['thumbnail'] + '" alt="' + itinerary['tourtitle'] + '">';
            str += '<div class="card-body">';
            str += '<h5 class="card-title">' + itinerary['tourtitle'] + '</h5>';
            str += '<p class="card-text">Price: $' + itinerary['price'] + '</p>';
            str += '<a href="#" class="btn btn-warning">View More</a>';
            str += '</div></div>';
        }
        str += '</div>';

        document.getElementById("cards").innerHTML = str;
    }

    function filterCategory(cat) {
        str = '<div class="card-columns">'
        for (itinerary of jsItinerary) {
            if (cat != itinerary['tourcategory']) {
                continue;
            }
            
            str += '<div class="card">';
            str += '<img class="card-img-top" src="images/' + itinerary['thumbnail'] + '" alt="' + itinerary['tourtitle'] + '">';
            str += '<div class="card-body">';
            str += '<h5 class="card-title">' + itinerary['tourtitle'] + '</h5>';
            str += '<p class="card-text">Price: $' + itinerary['price'] + '</p>';
            str += '<a href="#" class="btn btn-warning">View More</a>';
            str += '</div></div>';
        }
        str += '</div>';

        document.getElementById("cards").innerHTML = str;
    }
</script>

<!-- convert session userid to javascript -->
<script type="text/javascript">
    var jsSessionUserId = <?php echo json_encode($_SESSION['userid']); ?>;
    sessionStorage.setItem("userid",jsSessionUserId);
    // console.log(jsSessionUserId);
    // console.log("HELLO");
</script>

</body>
</html>