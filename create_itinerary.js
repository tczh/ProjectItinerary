window.onload=function(){
  var queryString = window.location.search;
  var urlParams = new URLSearchParams(queryString);
  var userid = sessionStorage.getItem("userid");
  console.log(userid);
  
    var addDayBtn = document.getElementById("add-day-btn");
    addDayBtn.addEventListener("click", incrementValue, false); 

    // var checkImageBtn = document.getElementById("checkImageBtn");
    // checkImageBtn.addEventListener("click", checkImage, false); 

    country_dropdown();
    console.log("in onload func");

    activatePlacesSearch();

};

var is_image = function () {
  document.getElementById('image').src = document.getElementById('imageUrl').value;
}

var errorCallback = function () {
  alert('Image did not exist. Input a valid image url');

  // var el = document.getElementById("error-body");
  // el.innerHTML = 'Image does not exist. Provide a valid image url';
  // document.getElementById("errorsLabel").innerText = "Upload Image";
  // $('#errors').modal(show);

}

var loadCallback = function () {
  alert('Image exists. Thank you.');

  // var el = document.getElementById("error-body");
  // el.innerHTML = 'Image exists. Thank you.';
  // document.getElementById("errorsLabel").innerText = "Upload Image";
  document.getElementById("itinerary-image").setAttribute("src",document.getElementById('imageUrl').value );
  // $('#errors').modal(show);

  
}

function removeImage() {
  var src = document.getElementById('itinerary-image').src;
  if (src.length>0) {
    document.getElementById("itinerary-image").setAttribute("src","");
  } else {
    alert("No image to remove!");
  }
}

// function checkImage() {
//   var url = document.getElementById("imageUrl").value;
//   console.log(url);
//   console.log(typeof(url));
//   if (/(jpg|gif|png|jpeg)$/i.test(url)){ // image url as input
//       if (is_image_valid(url)){ // image found
//           console.log('image_ok') ;
//       } else { // image couldnt be found
//           console.log('image_not');
//       }
//   } else { // string as input
//       console.log('string');
//   }
// };

// function is_image_valid(src) {
//   // Create new offscreen image to test
//   var image_new = new Image();
//   image_new.src = src;
//   console.log(image_new.src);
//   console.log("image width = " + image_new.width);
//   console.log("image height = " + image_new.height);
//   // Get accurate measurements from that
//   if ((image_new.width>0)&&(image_new.height>0)){
//       return true;
//   } else {
//       return false;
//   }
// };
  

function activatePlacesSearch(){
  var inputs = document.getElementsByClassName("location");

  for (var input of inputs) {
    var autocomplete = new google.maps.places.Autocomplete(input);
  };

}; 

function addNewActivity(day_num) {
  var activityNumber = incrementValueActivity();

  //console.log( "This is the activity number" + activityNumber);

  var html = `
  <div class="container pt-2 pb-2 mt-2 mb-2" id="activity${activityNumber}">

  <div class="form-group row">
    <label for="activity-title-input" class=" col-sm-2 col-form-label" >Activity Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control activity-title"  placeholder="">
    </div>
  </div>

  <div class="form-group row">
    <label for="start-time-input" class=" col-sm-2 col-form-label"> Start Time</label>
    <div class="col-sm-4">
      <input type="time" class="form-control startTime" placeholder="">
    </div>

    <label for="end-time-input" class=" col-sm-2 col-form-label"> End Time</label>
    <div class="col-sm-4">
      <input type="time" class="form-control endTime"  placeholder="">
    </div>
  </div>

  <div class="form-group row">
    <label for="location-input" class=" col-sm-2 col-form-label" >Location</label>
    <div class="col-sm-10">
      <input type="text" class="form-control location" placeholder="" >
    </div>
  </div>
  
  <div class="form-group row">
    <label for="description-input" class=" col-sm-2 col-form-label" >Description</label>
    <div class="col-sm-10">
      <textarea class="form-control description"  placeholder="Write your comments here" rows="5"></textarea>
    </div>
  </div>

  <div class="d-flex justify-content-center"> 
    <button type="button" class="btn btn-warning" onclick="removeActivity(${activityNumber})">Remove activity</button>
  </div>

  </div>
  `;

  var node = document.getElementById(`activitiesDay${day_num}`);
  node.insertAdjacentHTML("beforeend", html);
  activatePlacesSearch();

}

function removeActivity(activityNumber) {
  var element = document.getElementById(`activity${activityNumber}`);
  element.parentNode.removeChild(element);

}

var incrementValueActivity = (function(n) {
  return function() {
    n += 1;
    return n;
  }
}(1));

function incrementValue() {
    var value = parseInt(document.getElementById("add-day-btn").value, 10);
    //value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('add-day-btn').value = value;
    //console.log(value);

    addNewDay(value);
}

function addNewDay(day) {
    //console.log("add new day func ");

    var html = `
            <div class="container bg-light" id="contentDay${day}">

              <div class="form-group" style="margin: 20px 0px;">
                <div class="container">
                    <label class="h2 dayNum" >Day ${day}</label>
                    <button type="button" class="btn btn-warning m-3" id="removeDay${day}" value="${day}" onclick="removeElement(${day})" style="display: inline-block;">Remove</button>
                </div>
                <input type="date" class="form-control date" placeholder="">
              </div>

              <!--start of container of activities for day-->
              <div class="container" id="activitiesDay${day}">
              <!-- start of container of first item in day -->
              <div class="container pt-2 pb-2" >

                <div class="form-group row">
                  <label for="activity-title-input" class=" col-sm-2 col-form-label" >Activity Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control activity-title"  placeholder="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="start-time-input" class=" col-sm-2 col-form-label"> Start Time</label>
                  <div class="col-sm-4">
                    <input type="time" class="form-control startTime"  placeholder="">
                  </div>

                  <label for="end-time-input" class=" col-sm-2 col-form-label"> End Time</label>
                  <div class="col-sm-4">
                    <input type="time" class="form-control endTime"  placeholder="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="location-input" class=" col-sm-2 col-form-label" >Location</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control location" placeholder="" >
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="description-input" class=" col-sm-2 col-form-label" >Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control description" placeholder="Write your comments here" rows="5"></textarea>
                  </div>
                </div>

              </div>
              <!-- end of container of first item in day  -->
              </div>
              <!--end of container of activities for day-->
              <button type="button" class="btn btn-primary m-3" id="add-activity-btn${day}" value="${day}" onclick="addNewActivity(this.value)">Add another activity</button>
                
            </div>
    `;

    var node = document.getElementById("main-content");
    node.insertAdjacentHTML("beforeend", html);

    activatePlacesSearch();

}


function removeElement(day) {
    var id = `contentDay${day}`;
    //console.log("remove ele");
    //console.log(id);
    var element = document.getElementById(id);
    //console.log(element);
    element.parentNode.removeChild(element);

    fixDayNum(day);
}

function fixDayNum(day) {
    console.log("in fix day num");
    var day_removed = parseInt(day);

    var value = parseInt(document.getElementById("add-day-btn").value, 10);
    console.log(`${value} is value`);
    if (day_removed == value) {
        // console.log("-------in if day_removed == value---")
        // console.log(`${day_removed} is day removed`);
        value = value - 1;
        //console.log(`${value} is the value after fixing`)
        document.getElementById('add-day-btn').value = value;
    } else {
        var arr_nodes = document.getElementsByClassName("dayNum");
        // console.log("-------in else------");
        // console.log(`${day_removed} is day removed`);
        var index = day_removed - 1;
        //console.log(index);
        var nodes = Array.prototype.slice.call(arr_nodes, index)
        //console.log(nodes);
        //console.log("---------------");

        for (node of nodes) {
            //console.log(node);

            var regex = /\d+/g;
            var dayNum = node.innerText.match(regex);

            dayNum = dayNum[0] - 1;

            //console.log(`This is the org day num : ${org_dayNum} and this is the new day num: ${dayNum}`);

            node.innerText = `Day ${dayNum}`;

            var org_dayNum = dayNum+1;

            // console.log(`Elements before change: `);
            // console.log(document.getElementById(`removeDay${org_dayNum}`).onclick);
            // console.log(document.getElementById(`removeDay${org_dayNum}`).value);
            // console.log(document.getElementById(`removeDay${org_dayNum}`).id);
            // console.log(document.getElementById(`contentDay${org_dayNum}`));

            document.getElementById(`removeDay${org_dayNum}`).id = `removeDay${dayNum}`;
            document.getElementById(`removeDay${dayNum}`).setAttribute('onclick',`removeElement(${dayNum})`);
            document.getElementById(`removeDay${dayNum}`).setAttribute('value',`${dayNum}`);
            document.getElementById(`contentDay${org_dayNum}`).id = `contentDay${dayNum}`;
            document.getElementById(`activitiesDay${org_dayNum}`).id = `activitiesDay${dayNum}`;
            document.getElementById(`add-activity-btn${org_dayNum}`).id = `add-activity-btn${dayNum}`;
            document.getElementById(`add-activity-btn${dayNum}`).value = dayNum;

            // console.log(`Elements after change: `);
            // console.log(document.getElementById(`removeDay${dayNum}`).onclick);
            // console.log(document.getElementById(`removeDay${dayNum}`).value);
            // console.log(document.getElementById(`removeDay${dayNum}`).id);
            // console.log(document.getElementById(`contentDay${dayNum}`).id);

            //console.log(idNodeList);

            //console.log("---------------");
        }

        value = value - 1;
        //console.log(`${value} is the value after fixing`)
        document.getElementById('add-day-btn').value = value;
    }
    activatePlacesSearch();
    

}




function country_dropdown() {
  //console.log("in country_dropdown");
  const countryList = [
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
  str = "";
  for(var i=0; i<countryList.length;i++){
    str +=`<option value="${countryList[i]}">${countryList[i]}</option>`;
  };
  var el = document.getElementById("country-select");
  el.innerHTML = str;

};

