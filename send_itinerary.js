function validateData() {
    userid = sessionStorage.getItem('userid');
    console.log(userid);
    remove_additional_html();

    var title = document.getElementById("itinerary-title").value;
    //var country = document.getElementById("country-select").value;
    //var imageURL = document.getElementById("imageUrl").value;

    var errors = [];
    //console.log(title);
    if (title.length  == 0) {
        errors.push("Title of itinerary is empty. </br>");
    }
    
    //12/11
    var generaldetails = document.getElementById("generaldetails").value;
    if (generaldetails.length  == 0) {
        errors.push("Summary of itinerary is empty. </br>");
    }


    // if (imageURL.length  == 0) {
    //     errors.push("Image URL is empty. </br>");
    // }

    if (document.querySelector('input[name="season"]:checked') == null) {
        errors.push("Select a season. </br>")
    };

    if (document.querySelector('input[name="category"]:checked') == null) {
        errors.push("Select a category. </br>")
    };

    

    var price = document.getElementById("price").value;
    if (checkPrice(price)) {
        errors.push("Price is invalid. Enter again. </br>");
    }

    //console.log (`Title: ${title},country: ${country},imageURL: ${imageURL}, season: ${season}, category: ${category} , day1_date : ${day1_date }, price: ${price}`)

    //var day1_el = document.getElementById("activitiesDay1");


    //modified this
    var activity_titles = document.getElementsByClassName("activity-title");
    var startTime = document.getElementsByClassName("startTime");
    var endTime = document.getElementsByClassName("endTime");
    var location = document.getElementsByClassName("location");

    //end of modification

    //var description = day1_el.getElementsByClassName("description");

    var list_to_check = [activity_titles, startTime, endTime, location];
    if (checkEmpty(list_to_check)) {
        errors.push("Do not leave any information blank (excluding description)! </br>");  
    }

    //newly added

    if ((checkEmpty(list_to_check) == false) ) {
        if (checkTime(startTime, endTime)) {
            errors.push("End Time can not be before Start Time. Re-enter. </br>");
        };
    };

    //end of newly added content

    var error_str = "";
    for (error of errors) {
        error_str += error;
        console.log(error);
    }

    if (error_str.length>0) {
       var el = document.getElementById("error-body");
       el.innerHTML = error_str;
       document.getElementById("errorsLabel").innerText = "Fix these errors before submission";
       $('#errors').modal('show');
       
    } else {
        console.log("time to session storage and call api.");

        document.getElementById("error-body").innerHTML = "Ready to show your itinerary to the World?";
        document.getElementById("errorsLabel").innerText = "Continue with submission?";
        var html = `<button type="button" class="btn btn-primary new-item" onclick="storeItinerary()">Confirm</button>`;
        var node = document.getElementById(`errorsFooter`);
        node.insertAdjacentHTML("beforeend", html);
        $('#errors').modal('show')
    };

    // printValue(startTime);
    // console.log("--------------");
    // printValue(endTime);
    // console.log("--------------");

    // printValue(activity_titles);
    // console.log("--------------");
   
    // printValue(location);
    // console.log("--------------");
    // printValue(description);

};

function remove_additional_html() {
    while (document.getElementsByClassName('new-item')[0]) {
            document.getElementsByClassName('new-item')[0].remove();
    };  
};

//newly added
function checkTime(startTimeList, endTimeList) {

    //var n = startTimeList.length;

    for (i = 0; i < startTimeList.length; i++) {
        var startTime = startTimeList[i].value;
        var endTime = endTimeList[i].value;

        var startTimeArr = startTime.split(":");
        var endTimeArr = endTime.split(":");

        var startHour = startTimeArr[0];
        var startMinute = startTimeArr[1];
       
        var endHour = endTimeArr[0];
        var endMinute = endTimeArr[1];
       
        if (endHour < startHour) {
            return true;
        } else if ( (endHour == startHour) && (endMinute < startMinute) ) {
            return true;
        };
    }

    return false;

}

//end of newly added content

function checkEmpty(list) {
    //modified this
    for (node of list) {

        for(element of node) {
            var el = element.value;
            if ((el === "") ||  (typeof el === 'undefined')){
                //console.log("checkempty");
                return true;   
            }

        }
    }

    return false;

    //end of modification
};

function checkPrice(price) {
    var regex = /^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
    if (!regex.test(price)) {
        return true;
    }  

    return false;
};

// function printValue(nodelist) {
//     for (node of nodelist) {
//         var value = node.value;
//         if (value === "") {
//             console.log("Empty");
//         } else {
//             console.log(value);
//         }
        
//     }
// }


function storeItinerary() {
    var itineraryOwner = sessionStorage.getItem('userid'); //hardcoded data

    sessionStorage.setItem("itineraryOwner", itineraryOwner);
    var tourTitle = document.getElementById("itinerary-title").value;
    var tourCategory = document.querySelector('input[name="category"]:checked').value;
    var country = document.getElementById("country-select").value;
    var price = document.getElementById("price").value;
    var imageURL = document.getElementById("imageUrl").value;
    //12/11
    var generaldetails = document.getElementById("generaldetails").value;

    var imageExists = sessionStorage.getItem("imageExists");
    console.log("ImageExists in session storage: " + imageExists);
    if (imageURL.length == 0 || imageExists == 'false') {
        imageURL = "/images/travel.jpg";
    } ;

    //end of 12/11

    var thumbnail = imageURL;
    var season = document.querySelector('input[name="season"]:checked').value;

    console.log("------------");
    console.log(itineraryOwner);
    console.log(tourTitle);
    console.log(tourCategory);
    console.log(country);
    console.log(price);
    console.log(thumbnail);
    console.log(season);
    console.log("------------");

    InsertItinerary(itineraryOwner, tourTitle, tourCategory, country,price, thumbnail,season, generaldetails);

    //finish inserting values into Itinerary table

    //now insert values into Itinerary details table

    //retrieve itinerary ID

    retrieveItineraryId();


};


function InsertItinerary(itineraryOwner, tourTitle, tourCategory, country,price, thumbnail,season, generaldetails) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Successfully inserted itinerary...!");
            console.log(this);
        }
    }

    var url = `api/Itinerary/InsertItinerary.php?itineraryowner=${itineraryOwner}&tourtitle=${tourTitle}&tourcategory=${tourCategory}&country=${country}&price=${price}&thumbnail=${thumbnail}&season=${season}&generaldetails=${generaldetails}`; 
    request.open("GET", url, true);
    request.send();

};

function retrieveItineraryId(){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this);
            InsertItineraryDetails(this);
            // Create a new API that retrieves the object retrieveJSONObject(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/Itinerary/RetrieveMaxItinerary.php" , true);
    console.log(request);
    request.send();
}

function InsertItineraryDetails(xml) {

    // console.log(obj.responseText);

    var response_json = JSON.parse(xml.responseText);
    console.log(response_json);
    var itineraryId = response_json.records[0].itineraryid;

    console.log("This is the itineraryId in InsertItineraryDetails  " + itineraryId);

    //need fix this => giving me null value currently

    //var itineraryId = 3; //hardcoded data 
    sessionStorage.setItem("itineraryId",itineraryId);
    var itineraryOwner = sessionStorage.getItem("itineraryOwner");

    var days = document.querySelectorAll('[id^="contentDay"]');

    console.log(days);

    console.log(days.length);

    var dayNum = 1;

    for (day of days) {
        InsertEachDetail(day, dayNum);
        dayNum += 1;
    };

};

function InsertEachDetail(day, dayNum) {
    var itineraryid = sessionStorage.getItem("itineraryId");
    var itineraryowner = sessionStorage.getItem("itineraryOwner");

    var daynumber = dayNum;
    
    var activities = day.querySelectorAll(".activity-title");
    var startTimes = day.querySelectorAll(".startTime");
    var endTimes = day.querySelectorAll(".endTime");
    var locations = day.querySelectorAll(".location");
    var descriptions = day.querySelectorAll(".description");

    for (activityNum = 0; activityNum < activities.length; activityNum++) {
        var location = locations[activityNum].value;
        var activity = activities[activityNum].value;
        var activitynumber = activityNum + 1;
        var description = descriptions[activityNum].value;
        var starttime = startTimes[activityNum].value;
        var endtime = endTimes[activityNum].value;

        console.log("------------");
        console.log(location);
        console.log(activity);
        console.log(activitynumber);
        console.log(description);
        console.log(starttime);
        console.log(endtime);
        console.log("------------");

        InsertDetail(itineraryid, itineraryowner,daynumber, location, activity,activitynumber,description, starttime, endtime );
        
    };
};

function InsertDetail(itineraryid, itineraryowner,daynumber, location, activity,activitynumber,description, starttime, endtime ) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Successfully inserted itinerary details...!");
            console.log(this);
        }
    }

    var url = `api/Itinerary/InsertItineraryDetails.php?itineraryid=${itineraryid}&itineraryowner=${itineraryowner}&daynumber=${daynumber}&location=${location}&activity=${activity}&activitynumber=${activitynumber}&description=${description}&starttime=${starttime}&endtime=${endtime}`;
    request.open("GET", url, true);
    request.send();
}
