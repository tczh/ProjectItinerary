<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ItineraryPage </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUK5A7DQz1wWMlQ98p9fqg2zIv-XQDCjc&callback=initMap&libraries=&v=weekly" defer></script>
    <style>
        .style1{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            background-color: #dbdbf0;
        }
        

        #map {
            height: 300px;
            width: 18rem;
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 10px; /* Added */
        }
        .card {
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 10px; /* Added */
        }
        .highlight {
            background: url(https://www.andyhooke.co.uk/wp-content/uploads/2018/02/yellow-brushstroke.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding: 8px 0;
        }

        .highlight2 {
            background: url("brush-stroke-banner-3.png");
            background-repeat: no-repeat;
            background-position:center;
            background-size: 90% auto;
            padding: 8px 0;
            color:white;
        }
        
    </style>
</head>
<body>
    <?php
        if (!isset($_GET['itineraryid']) ) {
       
            // redirect to login page
            header("Location: index.html"); 
        
            // stop all further execution 
            // (if there are statements below)
            exit;
        }
    ?>
    <div class = "container">
        <div class="row" id="headerimg">
            <div class="col-sm-12 text-center" v-if="error != '1'" style="background:white;">

                <?php 
                    session_start();
                    $itineraryid= $_GET['itineraryid'];
                    // remove this line later!!
                    $_SESSION['email'] = '123';
                    if(isset($_GET['userid']) && isset($_SESSION['email'])){
                        $userid = $_GET['userid'];
                    }
                    else{
                        $userid = 0;
                    }
                
                ?>
                
                <img v-bind:src="thumbnail" style="width:100%;height:200px;object-fit:cover">
                <h1>{{title}}</h1>
                <h5>Experience {{country}} in <span class="font-italic">{{season}}</span></h5>
                <div v-if="commentsArray[0] != 'No comments'">
                    <span v-if="rate >=4.75">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=4.25">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star-half fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=3.75">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=3.25">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star-half fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=2.75">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=2.25">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star-half fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=1.75">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=1.25">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star-half fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=0.75">
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                        <i class='fa fa-star fa-lg' style='color:yellow'></i>
                    </span>
                    <span v-else-if="rate >=0.25">
                        <i class='fa fa-star-half fa-lg' style='color:yellow'></i>
                    </span>
                    <br>
                    <span style='font-size:14px'>Average Rating: {{rate}}/5</span>
                </div>
                <div class='text-right' style='font-size:14px;font-variant:small-caps'>
                    <span class='highlight'>Itinerary created by {{owner}}</span>
                </div>
                <hr>
                
            </div>
            <div class="col-sm-8 text-center" v-if="error != '1'">
                <h3>Activities for Day 1</h3>
                <div class='style1 p-3 mt-4 mb-4' v-for="activities in activityArray">
                    <h5>{{activities["activity"]}}</h5>
                    <i class="fa fa-map-marker" style='color:red'></i> {{activities['location']}} <br>
                    <i class="fa fa-clock-o" style='color:green'></i> {{activities['starttime']}} - {{activities['endtime']}} <br>
                    <br>
                    {{activities['description']}}
                </div>
                <div>
                    ...<br>
                    Your preview ends here
                </div>

                <div class='mt-5'>
        
                    <h5 v-if="userid1 ==0">Interested in finding out more? <a href="login.php">Click here</a> to add this itinerary to your cart now!!</a></h5>
                    <h5 v-else>Interested in finding out more? <a href="checkout.html" v-on:click='insertCart()'>Click here</a> to add this itinerary to your cart now!!</a></h5>
                </div>
            </div>
            <div class="col-sm-4 text-center" style="background:white;" v-if="error != '1'">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <span style='font-size:14px'>
                            100% Original Itinerary <i class="fa fa-check-circle" style='color:green'></i>
                        </span>
                        <h5 class="card-title">Tour Title: {{title}}</h5>
                        <p class="card-text text-left">
                            Category: 
                            <span v-if="category == 'luxury'" class="badge badge-primary">{{category}}</span>
                            <span v-if="category == 'budget'" class="badge badge-danger">{{category}}</span>
                            <span v-if="category == 'nature'" class="badge badge-success">{{category}}</span>
                            <span v-if="category == 'city'" class="badge badge-info">{{category}}</span>
                            <span v-if="category == 'others'" class="badge badge-secondary">{{category}}</span>
                            <br>
                            Price: {{price}}
                        </p>
                        <a href="login.php" class="btn btn-warning p-2" style="font-size:14px" v-if="userid1 ==0">ADD TO CART <i class="fa fa-cart-plus"></i></a>
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-warning p-2" style="font-size:14px" v-else v-on:click="insertCart()">ADD TO CART <i class="fa fa-cart-plus"></i></button>
              
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{title}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <i class='fa fa-shopping-cart' style='font-size:100px;float:left'></i> <br>
                                    {{title}} has been added to the cart! 
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a type="button" class="btn btn-primary" href='checkout.html'>Checkout</a>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="map"></div>
            </div>
            
            <div class="col-sm-8 text-center mb-4" v-if="error != '1'">
                <hr>
                <h2 class='highlight2'>Reviews</h2>
                <div v-if="commentsArray[0] == 'No comments'">
                    This itinerary has not been reviewed yet :(
                </div>
                <div v-else>
                    <div class='style2 text-left p-3 ' v-for="comments in commentsArray">
                        
                        
                        <h5>
                            {{comments['userid']}} &nbsp
                            
                            <span v-for="i in parseInt(comments['rate'])" style='font-size:14px'>
                                <i class='fa fa-star fa-lg' style='color:yellow'></i>
                            </span>
                            <span style='float:right'>
                                <a><i class='fa fa-thumbs-o-up'></i></a>
                            </span>
                        </h5>
                        
                        <div class='mt-3'>
                            {{comments['message']}}
                        </div>
                        <div class='text-right' style='font-size:11px;font-variant:small-caps'>
                            <span style='color:grey'>11 November 2020</span>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class='mt-5 text-center' v-else>
                <h3>OOPS No such itinerary exists! <a href="index.php">Click here</a> to go back to home</h3>
                <img src='https://media4.giphy.com/media/L95W4wv8nnb9K/giphy.gif'>
            </div>
        </div>
    </div>
    
    <script>
        var app = new Vue({
            el:"#headerimg",
            data:{
                userid1: "<?php echo $userid ?>",
                country:'',
                owner:'',
                price:'',
                season:'',
                thumbnail:'',
                category:'',
                title:'',
                error:'',
                activityArray :[],
                commentsArray:[],
                itineraryid: <?php echo $itineraryid ?>,
                apiKey: 'AIzaSyCUK5A7DQz1wWMlQ98p9fqg2zIv-XQDCjc',
                lat1:'',
                lng1:'',
                rate:0,
                error1:''
                
            },
            created:function(){
                let url = "api/itinerarypage/getItineraryPage.php?itineraryid=" + this.itineraryid
                axios.get(url)
                .then(response =>{
                    let post_array = response.data.records[0]
                    this.country =post_array['country']
                    this.owner = post_array['itineraryowner']
                    this.price = post_array['price']
                    this.season = post_array['season']
                    this.thumbnail = post_array['thumbnail']
                    this.category = post_array['tourcategory']
                    this.title = post_array['tourtitle']
                    url2 = "https://maps.googleapis.com/maps/api/geocode/json?address=" + this.country+ "&key=" + this.apiKey
                    axios.get(url2)
                    .then(response =>{
                        post_array2 = response.data.results[0].geometry.location
                        this.lat1 = post_array2['lat']
                        this.lng1 = post_array2['lng']
                        initMap(this.lat1,this.lng1)
                    }).catch(error =>{
                        this.error="1"
                    })
            
                }).catch(error =>{
                    this.error="1"
                })

                url = "api/itinerarydetails/getBoughtItineraryDetails.php?itineraryid=" + this.itineraryid
                axios.get(url)
                .then(response =>{
                    
                    post_array = response.data.records
                    for (record of post_array){
                        if(record['daynumber'] == 1){
                            this.activityArray.push(record)
                        }
                    }
                }).catch(error =>{
                    this.error="1"
                })
                
                url = "api/itinerarypage/getItineraryReview.php?itineraryid=" + this.itineraryid
                axios.get(url)
                .then(response =>{
                    console.log(response)
                    post_array = response.data.records
                    count = post_array.length
                    
                    for (record of post_array){
                        this.rate += parseInt(record['rate'])
                    }
                    this.rate = this.rate/count
                    if(count<=3){
                        for (record of post_array){
                            this.commentsArray.push(record)
                        }
                    }
                    else{
                        for (i=1; i<4; i++){
                            this.commentsArray.push(post_array[count-i])
                        }
                    }
                }).catch(error =>{
                    this.commentsArray=["No comments"]
                })
                
                
                if (this.userid1 != 0){
                    console.log('if user exists do api call for addcart table !! TO DO !! Check also if is creator or is already bought')
                }
    
            },
            methods:{
                insertCart: function(){
                    console.log(this.itineraryid)
                    console.log(this.userid1)
                    url = "api/itinerarypage/insertCart.php?userid=" + this.userid1 + "&itineraryid=" + this.itineraryid             
                    axios.get(url)
                    .then(response =>{
                    }).catch(error =>{
                        this.error1="Error"
                    })
                }  
            }
        }) 
    </script>

    <script>
        function initMap(lat1, lng1) {
            lat1 = parseFloat(lat1);
            lng1 = parseFloat(lng1);
            const uluru = { lat: lat1, lng: lng1 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            const marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
            
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>