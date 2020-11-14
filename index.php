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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="index.js"></script>

    <title>Welcome To Tim's Travel Agent</title>

    <style>
        * {
               margin: 0;
               /* padding: 0; */
        }

        .hero{
            background-image: url("scenery.jpg");
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 100%;
            margin-bottom: 12px;
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
            min-width: 320px;
        }

        #searchText{
            /* font-weight: bold; */
            font-size: 30px;
        }

        #price-range {
            /* padding: 0.5px; */
        }

        /* #date-picker {
            margin-bottom: 16px;
        } */

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

        #nextback {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        #nextbtn, #backbtn {
            margin-left: 10px;
            margin-right: 10px;
        }

    </style>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="super.css">
</head>
<body onload="load()">
    
    <!-- Navbar collapse if width is sm-->
    <header class="hero">
    <nav id="navbar" class="navbar top fixed-top navbar-dark navbar-expand-md" style="background-color: #023047;">
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
                

                <div class="form-group">
                    <select class="form-control" id="pricerange">
                    <option value='0'>Price Range</option>
                    <option value='1'>Less than $10</option>
                    <option value='2'>$10 - $19.99</option>
                    <option value='3'>$20 - $29.99</option>
                    <option value='4'>$30 - $39.99</option>
                    <option value='5'>$40 - $49.99</option>
                    <option value='6'>$50 or more</option>
                    </select>
                </div>

            

                <div class="form-group">
                    <select class="form-control" id="season">
                        <option>Season</option>
                        <option>Spring</option>
                        <option>Summer</option>
                        <option>Fall</option>
                        <option>Winter</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control" id="category">
                    <option>Category</option>
                    <option>Luxury</option>
                    <option>Budget</option>
                    <option>Nature</option>
                    <option>City</option>
                    <option>Others</option>
                    </select>
                </div>

                <button class="btn btn-warning" type="submit" onclick=filter()>Search</button>
            </div>
        </div>
    </div>
    </header>


    
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
            
            
        }
        
    ?>


    </div>


    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    <div class='d-none' id='jsitin'></div>
    <div id="nextback">
        <button class="btn btn-warning" id="backbtn" disabled onclick="back()">Back</button>
        <button class="btn btn-warning" id="nextbtn" onclick="next()">Next</button>
    </div>

    <!--Footer-->
    <footer class="footer" style="background-color: #023047;color:white;">
      <div class="social">
        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
        <a href="#"><i class="fab fa-youtube fa-2x"></i></a>
        <a href="https://www.linkedin.com/in/timothy-chia-a23858100/"><i class="fab fa-linkedin fa-2x"></i></a>
      </div>
      <p>Copyright &copy; 2020 - Tim's Travel Agent</p>
    </footer>

    <div id='counter' class='d-none'>0</div>
    
   

    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqsd6B8t6d8EIDIhtISazAvVufIy07_-U&libraries=places&callback=load"></script>
    <!-- <script src="js/lightbox.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Date Range -->
    <!-- <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
            opens: 'left'
            }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script> -->

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    var jsItineraryWithoutRate = <?php echo json_encode($itineraryArray); ?>;

    rateArray = []
    for (itinerary of jsItineraryWithoutRate) {
        // console.log(itinerary);
        
        url = "api/itinerarypage/getItineraryReview.php?itineraryid=" + itinerary['itineraryid'];
        axios.get(url)
        .then(response =>{
            
            // console.log(response);
            
            post_array = response.data.records
            count = post_array.length
            rate = 0
            for (record of post_array){
                rate += parseInt(record['rate'])
            }
            // console.log(rate);
            rate = rate/count
            // console.log(rate);
            // if(count<=3){
            //     for (record of post_array){
            //         this.commentsArray.push(record)
            //     }
            // }
            // else{
            //     for (i=1; i<4; i++){
            //         this.commentsArray.push(post_array[count-i])
            //     }
            // }
            rateArray.push(rate.toFixed(2));

            console.log(rate);

           
        })
    }

    // rateArray = document.getElementById('rateArray');
    console.log(rateArray)

    

    jsItinerary = []
    count = 0;
    for (itinerary of jsItineraryWithoutRate) {
        console.log(rateArray[count])
        jsItinerary.push(itinerary)
        jsItinerary[count]['rate'] = rateArray[count];
        count += 1;
    }

    console.log(jsItinerary);


    function load() {
        var input = document.getElementById("locationInput");
        var autocomplete = new google.maps.places.Autocomplete(input);

        filter();
    }

    function filter() {
        jsItinerary = <?php echo json_encode($itineraryArray); ?>;

       

        var country = document.getElementById('locationInput').value;
        var price = document.getElementById('pricerange').value;
        // var daterange = document.getElementById('daterange').value;
        var season = document.getElementById('season').value;
        var category = document.getElementById('category').value;

        tempArray = rateArray.slice();
   
        var str = '<div class="card-columns">';

        arrayItinerary = []

        // console.log(jsItinerary);
        count = 0
        for (i=0;i<jsItinerary.length;i++) {
            // console.log(country);
            // console.log(itinerary['country']);
            if (country != '' && country.toLowerCase() != jsItinerary[i]['country'].toLowerCase()) {
                tempArray.splice(i,1);
                continue;
            }

            if (season != 'Season' && season.toLowerCase() != jsItinerary[i]['season'].toLowerCase()) {
                tempArray.splice(i,1);
                continue;
            }

            // console.log(itinerary);
            // console.log(category.toLowerCase());
            // console.log(itinerary['tourcategory'].toLowerCase());
            if (category != 'Category' && category.toLowerCase() != jsItinerary[i]['tourcategory'].toLowerCase().split(' ')[0]) {
                tempArray.splice(i,1);
                continue;
            }


            var priceArray = [[0,9.99], [10, 19.99], [20,29.99], [30,39.99], [40,49.99], [50, 9999999999]];

            // console.log(priceArray[(0)][0]);

            if (price != 0 && ((parseFloat(jsItinerary[i]['price']) < priceArray[(price-1)][0]) || (parseFloat(jsItinerary[i]['price']) > priceArray[(price-1)][1]))) {
                tempArray.splice(i,1);
                continue;
            }

            arrayItinerary.push(jsItinerary[i]);
            
            
        }

        jsItinerary = arrayItinerary;
        document.getElementById("jsitin").innerHTML = jsItinerary;
        var userid = sessionStorage.getItem("userid");
        
        for(i=0;i<jsItinerary.length;i++){
            str += '<div class="card">';
            str += '<img class="card-img-top" src="' + jsItinerary[i]['thumbnail'] + '" alt="' + jsItinerary[i]['tourtitle'] + '">';
            str += '<div class="card-body">';
            str += '<h5 class="card-title">' + jsItinerary[i]['tourtitle'] + '</h5>';
            str += `<p class="card-text">Rating: <span id='rating${i}'> </span> <i class='fa fa-star' style='color:orange'></i></p>`;
            str += '<p class="card-text">Country: ' + jsItinerary[i]['country'] + '</p>';
            str += '<p class="card-text">Price: $' + jsItinerary[i]['price'] + '</p>';
            str += '<p class="card-text">Category: ' + jsItinerary[i]['tourcategory'] + '</p>';
            str += '<p class="card-text">Season: ' + jsItinerary[i]['season'] + '</p>';
            str += '<a href="ItineraryPage.php?itineraryid='+ jsItinerary[i]['itineraryid'] + '&userid=' + userid +'" class="btn btn-warning">View More</a>';
            str += '</div></div>';
            count++
            if(count==3){
                break
            }
        }

        console.log(jsItinerary, 'fuck');

        str += '</div>';

        document.getElementById("cards").innerHTML = str;

        console.log(tempArray, 'fk');

        counts = 0
        for(i=0;i<jsItinerary.length;i++){
            document.getElementById(`rating${i}`).innerHTML = tempArray[i];
            counts++
            if(counts ==3){
                break;
            }
        }
        document.getElementById('counter').innerText = 0
        $('#backbtn').attr('disabled', true);

        console.log(jsItinerary.length)
        if (jsItinerary.length <= 3) {
            $('#nextbtn').attr('disabled', true);
        }
        else{
            $('#nextbtn').attr('disabled', false);
        }
    }

    function next() {
  
        if (document.getElementById('counter').innerText < jsItinerary.length) {
            
            var country = document.getElementById('locationInput').value;
            var price = document.getElementById('pricerange').value;
            // var daterange = document.getElementById('daterange').value;
            var season = document.getElementById('season').value;
            var category = document.getElementById('category').value;
            document.getElementById('counter').innerText = parseInt(document.getElementById('counter').innerText) +3
            var str = '<div class="card-columns">';

            // console.log(jsItinerary);
            // console.log(document.getElementById('counter').innerText);

            count = parseInt(document.getElementById('counter').innerText);
            console.log(jsItinerary);
            console.log(count)
            counts = 0;
            for (i=count;i<jsItinerary.length;i++) {
                // console.log(country);
                // console.log(itinerary['country']);
                if (country != '' && country.toLowerCase() != jsItinerary[i]['country'].toLowerCase()) {
                    continue;
                }

                if (season != 'Season' && season.toLowerCase() != jsItinerary[i]['season'].toLowerCase()) {
                    continue;
                }

                // console.log(itinerary);
                // console.log(category.toLowerCase());
                // console.log(itinerary['tourcategory'].toLowerCase());
                if (category != 'Category' && category.toLowerCase() != jsItinerary[i]['tourcategory'].toLowerCase().split(' ')[0]) {
                    continue;
                }

                // console.log(price);
                // console.log(itinerary['price']);
                // console.log(priceArray[(0)][0]));

                var priceArray = [[0,9.99], [10, 19.99], [20,29.99], [30,39.99], [40,49.99], [50, 9999999999]];

                // console.log(priceArray[(0)][0]);

                if (price != 0 && ((parseFloat(jsItinerary[i]['price']) < priceArray[(price-1)][0]) || (parseFloat(jsItinerary[i]['price']) > priceArray[(price-1)][1]))) {
                    continue;
                }

                var userid = sessionStorage.getItem("userid");
                
                str += '<div class="card">';
                str += '<img class="card-img-top" src="' + jsItinerary[i]['thumbnail'] + '" alt="' + jsItinerary[i]['tourtitle'] + '">';
                str += '<div class="card-body">';
                str += '<h5 class="card-title">' + jsItinerary[i]['tourtitle'] + '</h5>';
                str += `<p class="card-text">Rating: <span id='rating${i}'> </span> <i class='fa fa-star' style='color:orange'></i></p>`;
                str += '<p class="card-text">Country: ' + jsItinerary[i]['country'] + '</p>';
                str += '<p class="card-text">Price: $' + jsItinerary[i]['price'] + '</p>';
                str += '<p class="card-text">Category: ' + jsItinerary[i]['tourcategory'] + '</p>';
                str += '<p class="card-text">Season: ' + jsItinerary[i]['season'] + '</p>';
                str += '<a href="ItineraryPage.php?itineraryid='+ jsItinerary[i]['itineraryid'] + '&userid=' + userid +'" class="btn btn-warning">View More</a>';
                str += '</div></div>';
                counts++
                if(counts== 3){
                    break;
                }

            }
            str += '</div>';

            document.getElementById("cards").innerHTML = str;
        }
        check=parseInt(document.getElementById('counter').innerText);
        counts = 0;
        console.log(check,'hi');
        console.log(jsItinerary.length-3,'gi');


        for(i=check;i<jsItinerary.length;i++){
            document.getElementById(`rating${i}`).innerHTML = tempArray[i];
            counts++;
            if(counts==3){
                break;
            }
        }
        
        // disable button

        if (check >= (jsItinerary.length)-3) {
            
            $('#nextbtn').attr('disabled', true);
        }
        if (check != 0) {
            $('#backbtn').attr('disabled', false);
        }
    
        
    }

    function back() {
        if (document.getElementById('counter').innerText > 0) {
            var country = document.getElementById('locationInput').value;
            var price = document.getElementById('pricerange').value;
            // var daterange = document.getElementById('daterange').value;
            var season = document.getElementById('season').value;
            var category = document.getElementById('category').value;
            document.getElementById('counter').innerText = parseInt(document.getElementById('counter').innerText) -3
            var str = '<div class="card-columns">';

            // console.log(jsItinerary);
            console.log(document.getElementById('counter').innerText);
            count = parseInt(document.getElementById('counter').innerText);
            counter = 0
            // console.log(count)
            for (i=count;i<jsItinerary.length;i++) {
                // console.log(country);
                // console.log(itinerary['country']);
                if (country != '' && country.toLowerCase() != jsItinerary[i]['country'].toLowerCase()) {
                    continue;
                }

                if (season != 'Season' && season.toLowerCase() != jsItinerary[i]['season'].toLowerCase()) {
                    continue;
                }

                // console.log(itinerary);
                // console.log(category.toLowerCase());
                // console.log(itinerary['tourcategory'].toLowerCase());
                if (category != 'Category' && category.toLowerCase() != jsItinerary[i]['tourcategory'].toLowerCase().split(' ')[0]) {
                    continue;
                }

                // console.log(price);
                // console.log(itinerary['price']);
                // console.log(priceArray[(0)][0]));

                var priceArray = [[0,9.99], [10, 19.99], [20,29.99], [30,39.99], [40,49.99], [50, 9999999999]];

                // console.log(priceArray[(0)][0]);

                if (price != 0 && ((parseFloat(jsItinerary[i]['price']) < priceArray[(price-1)][0]) || (parseFloat(jsItinerary[i]['price']) > priceArray[(price-1)][1]))) {
                    continue;
                }

                var userid = sessionStorage.getItem("userid");
                
                str += '<div class="card">';
                str += '<img class="card-img-top" src="' + jsItinerary[i]['thumbnail'] + '" alt="' + jsItinerary[i]['tourtitle'] + '">';
                str += '<div class="card-body">';
                str += '<h5 class="card-title">' + jsItinerary[i]['tourtitle'] + '</h5>';
                str += `<p class="card-text">Rating: <span id='rating${i}'> </span> <i class='fa fa-star' style='color:orange'></i></p>`;
                str += '<p class="card-text">Country: ' + jsItinerary[i]['country'] + '</p>';
                str += '<p class="card-text">Price: $' + jsItinerary[i]['price'] + '</p>';
                str += '<p class="card-text">Category: ' + jsItinerary[i]['tourcategory'] + '</p>';
                str += '<p class="card-text">Season: ' + jsItinerary[i]['season'] + '</p>';
                str += '<a href="ItineraryPage.php?itineraryid='+ jsItinerary[i]['itineraryid'] + '&userid=' + userid +'" class="btn btn-warning">View More</a>';
                str += '</div></div>';
                counter++
                if(counter==3){
                    break
                }
            }
            str += '</div>';

            document.getElementById("cards").innerHTML = str;
        }

        console.log(jsItinerary.length);
        console.log(tempArray, 'fk');

        check=parseInt(document.getElementById('counter').innerText);
        counts = 0
        for(i=check;i<jsItinerary.length;i++){
            document.getElementById(`rating${i}`).innerHTML = tempArray[i];
            counts++;
            if(counts==3){
                break;
            }
        }

        if (check == 0) {
            $('#backbtn').attr('disabled', true);
        }
        if (check <= jsItinerary.length-3) {
            $('#nextbtn').attr('disabled', false);
        }
    }

 
</script>

<!-- Convert session userid to javascript -->
<script type="text/javascript">
    var jsSessionUserId = <?php echo json_encode($_SESSION['userid']); ?>;
    sessionStorage.setItem("userid",jsSessionUserId);
</script>


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
