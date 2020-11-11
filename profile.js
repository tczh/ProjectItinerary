const countryList = ['',
    "Afghanistan",
    "Albania",
    "Algeria",
    "American Samoa",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antarctica",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bonaire",
    "Bosnia and Herzegovina",
    "Botswana",
    "Bouvet Island",
    "Brazil",
    "British Indian Ocean Territory",
    "Brunei Darussalam",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cayman Islands",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Christmas Island",
    "Cocos Islands",
    "Colombia",
    "Comoros",
    "Congo",
    "Congo",
    "Cook Islands",
    "Costa Rica",
    "Croatia",
    "Cuba",
    "Curaçao",
    "Cyprus",
    "Czechia",
    "Côte d'Ivoire",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Eswatini",
    "Ethiopia",
    "Falkland Islands",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "French Guiana",
    "French Polynesia",
    "French Southern Territories",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Greenland",
    "Grenada",
    "Guadeloupe",
    "Guam",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Heard Island and McDonald Islands",
    "Holy See",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Isle of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Kuwait",
    "Kyrgyzstan",
    "Lao People's Democratic Republic",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macao",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Martinique",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Norfolk Island",
    "Northern Mariana Islands",
    "Norway",
    "North Korea",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine, State of",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn",
    "Poland",
    "Portugal",
    "Puerto Rico",
    "Qatar",
    "Republic of North Macedonia",
    "Romania",
    "Russian Federation",
    "Rwanda",
    "Réunion",
    "Saint Barthélemy",
    "Saint Helena, Ascension and Tristan da Cunha",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Martin",
    "Saint Pierre and Miquelon",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Maarten",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Georgia and the South Sandwich Islands",
    "South Korea",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Svalbard and Jan Mayen",
    "Sweden",
    "Switzerland",
    "Syrian Arab Republic",
    "Taiwan",
    "Tajikistan",
    "Tanzania, United Republic of",
    "Thailand",
    "Timor-Leste",
    "Togo",
    "Tokelau",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Islands",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom of Great Britain and Northern Ireland",
    "United States Minor Outlying Islands",
    "United States of America",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela",
    "Vietnam",
    "Virgin Islands",
    "Wallis and Futuna",
    "Western Sahara",
    "Yemen",
    "Zambia",
    "Zimbabwe",
  ];

function onLoadData(){
    var userid = document.getElementById('userid2').innerText.trim(); 
    console.log(userid);
    displayProfile(userid);
    displayCreatedItinerary(userid);
    displayBoughtItinerary(userid);
}

function displayProfile(userid) {
    console.log("here");
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            firstName = responses["records"][0]["firstname"];
            lastName = responses["records"][0]["lastname"];
            email = responses["records"][0]["email"];
            country = responses["records"][0]["country"];
            password = responses["records"][0]["password"];
            address = responses["records"][0]["address"];

            passwordLen = password.length;
            passwordHolder ='';
            for(i=0; i<passwordLen;i++){
                passwordHolder += "*";
            }
            str1 =`
            <div class="form-group text-left">
                <form method="post" action="" id="editAcc">
                    <div class="form-row">
                        <div class="col">
                            <label class="mr-2">First Name</label> 
                            <input class="form-control" id="name1" name="firstname" type="text" placeholder="${firstName}" value="${firstName}" disabled="disabled"> 
                        </div>
                        <div class="col">
                            <label class="mr-2">Last Name</label> 
                            <input class="form-control" id="name2" name="lastname" type="text" placeholder="${lastName}" value="${lastName}" disabled="disabled"> 
                        </div>
                    </div>
                    <input type="hidden" id="userid" name="userid" value="${userid}"> 
                    <br><label class="mr-2">Email</label>
                    <input class="form-control" id="email" name="email" type="text" placeholder="${email}" value="${email}" disabled="disabled">
                    <br><label class="mr-2">Country</label>
                    <select class="form-control" id="country" name="country" disabled="disabled">`;
            for(var i=0; i<countryList.length;i++){
                if (countryList[i]==country){
                    str1+=`<option value="${countryList[i]}" selected>${countryList[i]}</option>`;
                }
                else{
                    str1+=`<option value="${countryList[i]}">${countryList[i]}</option>`;
                }
            }
            str1+=`
                    </select>
                    <div class="container text-center mt-4">
                        <input id="edit" type="button" value="Edit" class="btn btn-primary" onclick="editProfile()" data-toggle="collapse" data-target="#passwordInfo" aria-expanded="true" aria-controls="passwordInfo"">
                    </div>
                </form>
            </div>`;
            
            document.getElementById("accountInfo").innerHTML = str1;
            
            document.getElementById("passwordInfo").innerHTML= `
                <div class="form-group text-left">
                    <form method="post" action="" id="password1">
                        <div id="password4">
                            <label class="mr-2">Password</label> 
                            <input class="form-control" id="password3" name="password" type="password" value="${password}" placeholder="${passwordHolder}" disabled="disabled">
                        </div>
                        <input type="hidden" name="userid" value="${userid}">  </td>
                        <div class="container text-center mt-4" id="changeBtn">
                            <input id="password2" value="Edit" type="button" class="btn btn-primary" onclick="editPassword()" data-toggle="collapse" data-target="#accountInfo" aria-expanded="true" aria-controls="accountInfo">
                        </div>
                    </form>
                </div>
                `
                
        } 
        else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/profile/ProfileRead.php?userid=" + userid , true);
    request.send();
}

function editProfile(){
    document.getElementById("name1").disabled = "";
    document.getElementById("name2").disabled = "";
    document.getElementById("email").disabled = "";
    document.getElementById("country").disabled = "";
    document.getElementById("name1").placeholder = "";
    document.getElementById("name2").placeholder = "";
    document.getElementById("edit").value = "Save";
    document.getElementById("edit").onclick = checkProfile;
    getEmail();
    
}

function checkProfile(){
    userid= document.getElementById("userid").value
    emailValue = document.getElementById("email").value;
    firstname = document.getElementById("name1").value;
    lastname = document.getElementById("name2").value;
    emailDB = document.getElementById("emailstorage").innerText.trim().split(" ");
    errors =[];
    if(firstname.length ==0){
        errors.push("First name cannot be empty!")
    }
    if(lastname.length ==0){
        errors.push("Last name cannot be empty!")
    }

    for(i=0;i<emailDB.length;i++){
        if(emailDB[i] == emailValue && emailDB[i+1] != userid){
            errors.push("Email already exist in database");
        }
    }

    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(emailValue)){
        errors.push("Email must be valid");
    }

    if(errors.length >0){
        str="<ul style='list-style-position: inside'>"
        for(i=0;i<errors.length;i++){
            str+= "<li>" + errors[i] + "</li>";
        }
        str+="</ul>"
        document.getElementById("error1").innerHTML=str;
        
    }
    else{
        saveProfile();
    }

}

function saveProfile(){
    document.getElementById("edit").type="submit";
    document.getElementById("editAcc").action = "api/profile/ProcessAccEdit.php";
    onLoadData();
    document.getElementById("edit").onclick = editProfile;
}


function editPassword(){
    document.getElementById("password3").disabled = "";
    document.getElementById("password3").value = "";
    document.getElementById("password3").placeholder = "";
    document.getElementById("changeBtn").innerHTML=`<input id="password2" value="Save" type="button" class="btn btn-primary" onclick="checkPassword()">`;
    var para = document.createElement("div");
    para.setAttribute("id","confirmPassword")
    para.setAttribute("class","text-left")

    var element = document.getElementById("password4");
    element.appendChild(para);

    document.getElementById("confirmPassword").innerHTML = ` Confirm Password
    <input id="cfmValue" class="form-control" type="password">
    ` ;
}

function checkPassword(){
    pw1 = document.getElementById("password3").value;
    pw2 = document.getElementById("cfmValue").value;
    errors =[];
    if(pw1.length<6){
        errors.push("Password must have more than 5 characters!")
    }
    if(pw2 != pw1){
        errors.push("Password and confirm password must be the same!")
    }

    if(errors.length >0){
        str="<ul style='list-style-position: inside'>"
        for(i=0;i<errors.length;i++){
            str+= "<li>" + errors[i] + "</li>";
        }
        str+="</ul>"
        document.getElementById("error2").innerHTML=str;
        
    }
    else{
        savePassword();
    }
}

function savePassword(){
    document.getElementById("password2").type="submit";
    document.getElementById("password1").action = "api/profile/ProcessPassword.php";
    onLoadData();
    document.getElementById("password2").onclick = editPassword;
}

function getEmail(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            str='';
            for(record of responses["records"]){
                str+= record['email'] +" "+ record['userid'] + " "
            }
            document.getElementById("emailstorage").innerText = str;
            
        }
        else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    }
    request.open("GET", "api/profile/EmailRead.php", true);
    request.send();
}

function displayCreatedItinerary(userid){
    console.log("here");
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            str=`<div class="row">`;
            for (record of responses["records"]){
                str+=`
                <div class="col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="${record["thumbnail"]}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">${record["tourtitle"]}</h5>
                        <p class="card-text">
                            <strong>Country:</strong> ${record["country"]} <br>
                            <strong>Category:</strong> ${record["tourcategory"]} <br>
                            <strong>Season:</strong> ${record["season"]} 
                        </p>
                        <hr class="col-xs-12">
                        <div class="btn-group btn-block">
                            <a href="ItineraryDetails.php?itineraryowner=${userid}&itineraryid=${record["itineraryid"]}" class="btn btn-primary">View Itinerary</a>
                            <a href="#" class="btn btn-primary">Edit Itinerary</a>
                        </div>
                    </div>
                </div>
              </div>`
            }
            str+="</div>"
            document.getElementById("pills-profile").innerHTML = str;
        }
    else if (this.readyState == 4 &&  this.status == 404) {
        alert("Error reading file");
        return;
        }
    };


    request.open("GET", "api/profile/getOwnedItinerary.php?userid=" + userid , true);
    request.send();
}


function displayBoughtItinerary(userid){
    console.log("here");
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            str=`<div class="row">`;
            count =0;
            
            for (record of responses["records"]){
                console.log("Here");
                str+=`
                <div class="col-sm-6">
                    <div class="card">
                        <img class="card-img-top" src="${record["thumbnail"]}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">${record["tourtitle"]}</h5>
                        <p class="card-text">
                            <strong>Country:</strong> ${record["country"]} <br>
                            <strong>Category:</strong> ${record["tourcategory"]} <br>
                            <strong>Season:</strong> ${record["season"]} 
                        </p>
                        <hr class="col-xs-12">
                        <div class="btn-group btn-block">
                            <a href="ItineraryDetails.php?userid=${userid}&itineraryid=${record["itineraryid"]}" class="btn btn-primary">View Itinerary</a>
                            
                            <button type="button" data-toggle="modal" data-target="#reviewModal${count}" class="btn btn-primary" onClick="Process()">Leave Review</a>
                        </div>
                    </div>
                </div>
              </div>
              
                <div class="modal fade" id="reviewModal${count}" tabindex="-1" role="dialog" aria-labelledby="reviewModal${count}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${record["tourtitle"]} Review</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <textarea name="review" id="msg" rows="4" cols="60"></textarea>
                                <div class="stars">
                                    <input type="radio" name="star" id ="star-5" class="star star-5" value= "5">
                                    <label class="star star-5" for="star-5"></label>
                                    <input type="radio" name="star" id ="star-4" class="star star-4" value= "4">
                                    <label class="star star-4" for ="star-4" ></label>
                                    <input type="radio" name="star" id ="star-3" class="star star-3" value= "3">
                                    <label class="star star-3" for ="star-3"></label>
                                    <input type="radio" name="star" id ="star-2" class="star star-2" value= "2">
                                    <label class="star star-2" for ="star-2"></label>
                                    <input type="radio" name="star" id ="star-1" class="star star-1" value= "1">
                                    <label class="star star-1" for ="star-1"></label>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onClick="processReview(${userid},${record['itineraryid']})">Submit Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>`;
                console.log(count);
                count++
            }
            str+="</div>"
            document.getElementById("pills-home").innerHTML = str;
        }
    else if (this.readyState == 4 &&  this.status == 404) {
        alert("Error reading file");
        return;
    }
    };


    request.open("GET", "api/profile/getBoughtItinerary.php?userid=" + userid , true);
    request.send();
}

function processReview(userid, itineraryid){

    sessionStorage.setItem("userid", userid);
    sessionStorage.setItem("itineraryid", itineraryid);
    userid = sessionStorage.getItem("userid");
    itineraryid = sessionStorage.getItem("itineraryid");
    userid = sessionStorage.getItem("userid");
    sessionStorage.setItem("itineraryid",itineraryid);
    var nodes = document.getElementsByName('star');
    console.log(nodes);
    var comments = document.getElementById('msg').value;
    sessionStorage.setItem('comments',comments);
    var activityRating = 0;
    for(i = 0; i< nodes.length; i++){
        
        if(nodes[i].checked){
            activityRating = nodes[i].value;
            sessionStorage.setItem('rate',activityRating);
        }
        
    }
    if(activityRating == 0){
        alert("Please choose atleast one rating to review");
    }
    else{
        console.log("Entered here");
        //Change this API to Only payment table, itinerary table & review table joined
        // Check by paymentid -> if review table is empty -> then insert with status reviewed -> else dont do anything
        InsertDirectItineraryAPI(userid, itineraryid);
        
    }
    
function InsertDirectItineraryAPI(userid,itineraryid){
    console.log(userid);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this);
            InsertDirectItinerary(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/review/CheckReview.php?userid=" + userid + "&itineraryid=" + itineraryid , true);
    request.send();
}    

function InsertDirectItinerary(obj){
    var message = sessionStorage.getItem('comments');
    var rate = sessionStorage.getItem('rate');
    var userid = sessionStorage.getItem("userid");
    var itineraryid = sessionStorage.getItem('itineraryid');
    var date = Date(Date.now()); 
    var status = "Reviewed";
    var response_json = JSON.parse(obj.responseText);
    var paymentRecords = response_json["records"];
    for(element of paymentRecords){
        console.log(element);
        reviewid = element["reviewid"];
        if(reviewid == "" || reviewid == null){
            console.log("entered here");
            //call insertion to API
            insertRecords('DEFAULT',userid,itineraryid, rate, status,date, message);
        }
        //else{
          //  DisplayFeedback()
        //}
        
    }
}

function insertRecords(reviewid,userid,itineraryid,rate,status,date, message) {
    console.log(reviewid);
    console.log(userid);
    console.log(itineraryid);
    console.log(rate);
    console.log(status);
    console.log(date);
    console.log(message);
    itinerary_details = sessionStorage.getItem("itinerary_details");
    comments = sessionStorage.getItem("comments");
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Successfully inserted");
            var url = `/groupproject/ProfilePage.php?userid=` + userid;
            // Need to change it to retrieve all itineraries first
            location.href = url;
            //callReviewDetailsAPI('DEFAULT',reviewid,itinerary_details, rate, comments);
        }
    }

    var url = `api/review/InsertReview.php?reviewid=${reviewid}&userid=${userid}&itineraryid=${itineraryid}&rate=${rate}&status=${status}&date=${message}&message=${date}`; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();

}

}
function Redirect(){
    userid = sessionStorage.getItem('userid')
    var url = `/groupproject/NewReview.html?userid=` + userid;
    // Need to change it to retrieve all itineraries first
    location.href = url;
    console.log("here");
}