function onLoadData(){
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var usersid = urlParams.get("userid");
    var paymentid = urlParams.get("paymentid");
    var paymentsid = sessionStorage.getItem("paymentid");
    console.log(paymentid);
    if (paymentid == '' || paymentid == null){
        userid = sessionStorage.getItem("userid");
        console.log(userid);
        //call_api(userid);
        CreateNewAPI(userid);
    }
    else{
        if(paymentid == ''){
            sessionStorage.setItem('paymentsid',paymentsid);
            call_apiReview(paymentsid);
        }

        else{
            sessionStorage.setItem("paymentid",paymentid);
            console.log(paymentid);
            call_apiReview(paymentid);
        }
        
    }
    

}
function CreateNewAPI(userid) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            retrieveAllFeedbackJSON(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
        }
    };
    

    request.open("GET", "api/review/NewestFeedback.php?userid=" + userid , true);
    console.log(request);
    request.send();
}


function call_api(userid) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            retrieveJSONObject(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/review/ReadReview.php?userid=" + userid , true);
    console.log(request);
    request.send();
}
function retrieveAllFeedbackJSON(obj){
    userid = sessionStorage.getItem("userid");
    var tableHtml = `<table class="table  table-hover">
    <thead>
        <tr>
            <th scope='col'>Thumbnail</th>
            <th scope='col'>Tour Title</th>
            <th scope='col'>Tour Category</th>
            <th scope='col'>Country</th>
            <th scope='col'>Individual Activity Review</th>
            <th scope='col'>View Past Reviews</th>
        </tr>
        <tbody>
    `;
    console.log(obj.responseText);
    var response_json = JSON.parse(obj.responseText);
    
    var paymentRecords = response_json["records"];
    for(element of paymentRecords){
        console.log(element['image']);
        sessionStorage.setItem('tourtitle' + element['paymentid'], element['tourtitle']);
        tableHtml += `
        <tr>
        <td>${element['thumbnail']}</td>
        <td>${element['tourtitle']}</td>
        <td>${element['tourcategory']}</td>
        <td>${element['country']}</td>
        `;
        tableHtml += `<td><button class='btn btn-warning' onClick='StartReview(${element['paymentid']})' id='redirect'>Start Reviewing</button></td>
                <td><button data-toggle="modal" data-target="#exampleModalLong" class='btn btn-warning' onClick='ReviewItinerary(${element['paymentid']},${element['itineraryid']})'>This one need to edit & redict to wc's page</td>
                
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Review for This Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                            <div id="form">
                            
                                <textarea id="msg" name="message" placeholder="Comments" rows="4" cols="60" readonly></textarea>
                                <div class="stars">
                                    <input class="star star-5" id="star-5" value = '5' type="radio" name="star"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" value = '4'type="radio" name="star"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" value = '3' type="radio" name="star"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" value = '2' type="radio" name="star"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" value = '1'type="radio" name="star"/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>

                            </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="InsertDirectlyReview(${element['paymentid']}, ${element['itineraryid']})" id="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>`;
        tableHtml += `</tr>`;
    }
        tableHtml+='</tbody></table>'
        document.getElementById('arrayList').innerHTML = tableHtml;
    
}
function call_apiReview(paymentid){
    sessionStorage.setItem("paymentid",paymentid);
    console.log(paymentid);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this);
            retrieveByPaymentId(this);
            // Create a new API that retrieves the object retrieveJSONObject(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/review/ReadOne.php?paymentid=" + paymentid , true);
    console.log(request);
    request.send();
}
function retrieveByPaymentId(obj){
    var tourtitle = sessionStorage.getItem('tourtitle' + paymentid);
    console.log(tourtitle);
    var tableHtml = ``;
    document.getElementById('userid').innerText = tourtitle;
    tableHtml += `<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">
                Location
            </th>
            <th scope="col">
                Activity
            </th>
            <th scope="col">
                Description
            </th>
            <th scope="col">
                Day
            </th>
            <th scope="col">
                Start Time
            </th>
            <th scope="col">
                End Time
            </th>
            <th scope="col">
                Review
            </th>
        </tr>
    </thead>
    <tbody>`;
    console.log(obj.responseText);
    var response_json = JSON.parse(obj.responseText);
    var tour = '';
    var paymentRecords = response_json["records"];
    console.log(paymentRecords);
    for(element of paymentRecords){
        tableHtml += `<tr>
        <td>${element['location']}</td>
        <td>${element['activity']}</td>
        <td>${element['description']}</td>
        <td>${element['daynumber']}</td>
        <td>${element['starttime']}</td>
        <td>${element['endtime']}</td>`;
        if(element['ActivityRate'] == null || element['ActivityRate'] == ''){
            tableHtml += `
            <td><button class='btn btn-warning' data-toggle="modal" data-target="#exampleModalLong" onClick='ReviewIndividualActivity(${element['itineraryid']},${element['itinerary_details']})'>Review</button></td>`;
        }
        else{
            tableHtml += `
            <td><button class='btn btn-warning' data-toggle="modal" data-target="#exampleModalLong" onClick='ReviewIndividualActivity(${element['itineraryid']},${element['itinerary_details']})'>Successfully Reviewed</button></td>`;
        }
    }
    document.getElementById('retrieveTour').innerText = tourtitle;
    tableHtml += `</tr>`;
    tableHtml += `</table>`;
    document.getElementById('arrayList').innerHTML = tableHtml;
}
//Change to insert
function userid_api(userid) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            retrieveUserId(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/review/ReadReview.php?userid=" + userid , true);
    request.send();
}
function insertRecords(reviewid,userid,itineraryid,rate,status,date, message) {
    itinerary_details = sessionStorage.getItem("itinerary_details");
    comments = sessionStorage.getItem("comments");
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Successfully inserted");
            callReviewDetailsAPI('DEFAULT',reviewid,itinerary_details, rate, comments);
        }
    }

    var url = `api/review/InsertReview.php?reviewid=${reviewid}&userid=${userid}&itineraryid=${itineraryid}&rate=${rate}&status=${status}&date=${date}&message=${message}`; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();

}
function callReviewDetailsAPI(ReviewdetailsID,reviewid,itinerary_details, rate, comments){
    comments = comments.replaceAll("%20","");
    itinerary_details = itinerary_details.replaceAll("%20","");
    console.log(comments);
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Successfully Reviewed...!");
        }
    }

    var url = `api/review/InsertReviewDetails.php?ReviewdetailsID=${ReviewdetailsID}&reviewid=${reviewid}&itinerary_details=${itinerary_details}&ActivityRate=${rate}&comments=${comments}`; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();
    console.log(request);
}

// Edit this to Start Reviewing -> redirect to another page 10:14pm 8/11/2020.
function retrieveJSONObject(obj){
    userid = sessionStorage.getItem("userid");
    var tableHtml = `<table class="table  table-hover">
    <thead>
        <tr>
            <th scope='col'>Tour Title</th>
            <th scope='col'>Date of Purchase</th>
            <th scope='col'>Payment Id</th>
            <th scope='col'>Paid Status</th>
            <th scope='col'>Individual Activity Review</th>
            <th scope='col'>View Past Reviews</th>
        </tr>
        <tbody>
    `;
    console.log(obj.responseText);
    var response_json = JSON.parse(obj.responseText);
    
    var paymentRecords = response_json["records"];
    for(element of paymentRecords){
        console.log(element['image']);
        tableHtml += `
        <tr>
        <td>${element['tourtitle']}</td>
        <td>${element['datebought']}</td>
        <td>${element['paymentid']}</td>
        `;
        if(element['ispaid'] == 1){
            tableHtml += `<td>Paid</td>`;
            if(element['status'] == null){
                tableHtml += `<td><button class='btn btn-warning' onClick='StartReview(${element['paymentid']})' id='redirect'>Start Reviewing</button></td>
                <td><button data-toggle="modal" data-target="#exampleModalLong" class='btn btn-warning' onClick='ReviewItinerary(${element['paymentid']},${element['itineraryid']})'>This one need to edit & redict to wc's page</td>
                
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Review for This Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                            <div id="form">
                            
                                <textarea id="msg" name="message" placeholder="Comments" rows="4" cols="60" readonly></textarea>
                                <div class="stars">
                                    <input class="star star-5" id="star-5" value = '5' type="radio" name="star"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" value = '4'type="radio" name="star"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" value = '3' type="radio" name="star"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" value = '2' type="radio" name="star"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" value = '1'type="radio" name="star"/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>

                            </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="InsertDirectlyReview(${element['paymentid']}, ${element['itineraryid']})" id="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>`;
            }
            else if(element['status'] == ' ' || element['status'] == ''){
                tableHtml += `
                <td><button class='btn btn-warning onClick='StartReview(${element['paymentid']})' id='redirect'>Continue to review</button></td>
                <td><button class='btn btn-warning onClick='ReviewItinerary(${element['paymentid']},${element['itineraryid']})'>Continue to review entire itinerary</td>`;
            }
            else if(element['status'] == 'Reviewed'){
                sessionStorage.setItem('tourtitle',element['tourtitle']);
                tableHtml += `
                <td><button class='btn btn-warning' onClick='StartReview(${element['paymentid']})' id='redirect'>Start Reviewing</button></td>
                <td><button data-toggle="modal" data-target="#exampleModalLong" class='btn btn-warning' onClick='ReviewItinerary(${element['paymentid']},${element['itineraryid']})'>Successfully reviewed!</td>`;   
            }
        }
        else if(element['ispaid'] == 0){
            tableHtml += `
            <td>Not paid</td>
            <td><button class='btn btn-warning' onClick='Pay()'>Pay now to review!</button></td>
            <td><button class='btn btn-warning' onClick='Pay()'>Pay now to review!</button></td>
        
        `;
            
        }
        tableHtml += `</tr>`;
    }
        tableHtml+='</tbody></table>'
        document.getElementById('arrayList').innerHTML = tableHtml;
    }
//Edit here at 5.18pm

//edit here later 9.53pm 4/11
function InsertDirectlyReview(paymentid,itineraryid) {
    console.log(paymentid);
    userid = sessionStorage.getItem("userid");
    itineraryid = sessionStorage.getItem("itineraryid");
    console.log(itineraryid);
    console.log(userid);
    itinerary_details = sessionStorage.getItem("itinerary_details");
    console.log(itinerary_details);
    userid = sessionStorage.getItem("userid");
    sessionStorage.setItem("itineraryid",itineraryid);
    var nodes = document.getElementsByName('star');
    console.log(nodes);
    var comments = document.getElementById('msg').value;
    sessionStorage.setItem('comments',comments);
    for(i = 0; i< nodes.length; i++){
        
        console.log(activityRating);
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
        InsertDirectItineraryAPI(userid);
        
    }
    
    

}
//Retrieve from API by paymentid & itineraryid & reviewid
function ReviewItinerary(paymentid, itineraryid){
    
    console.log(itineraryid);
    console.log(userid);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this);
            ViewFeedback(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Sorry you have not yet submitted a feedback");
            var url = `NewReview.html`;
            location.href = url;
        }
    };
    request.open("GET", "http://localhost/wadproject/api/review/ViewFeedback.php?itineraryid=" + itineraryid , true);
    request.send();
    
}
//Edit this 10:13pm 8/11/2020 ---------> Finish up the array and display in modal popup.
function ViewFeedback(obj){
    var nodes = document.getElementsByName('star');
    console.log(nodes);
    for(i = 0; i< nodes.length; i++){
        
        if(nodes[i].checked){
            activityRating = nodes[i].value;
            console.log(nodes[i]);
            sessionStorage.setItem('rate',activityRating);
        }
        
    }
    tourtitle = sessionStorage.getItem('tourtitle');
    var response_json = JSON.parse(obj.responseText);
    var paymentRecords = response_json["records"];
    for(element of paymentRecords){
        document.getElementById('msg').innerText = element['message'];
        document.getElementById('exampleModalLongTitle').innerText = tourtitle;
        count = Math.floor(element['rate']);
        if(count == 1){
            radiobtn = document.getElementById('star-1');
            radiobtn.checked = true; 
        }
        else if(count == 2){
            radiobtn = document.getElementById('star-2');
            radiobtn.checked = true;
        }
        else if(count == 3){
            radiobtn = document.getElementById('star-3');
            radiobtn.checked = true;
        }
        else if(count == 4){
            console.log("looped here");
            radiobtn = document.getElementById('star-4');
            radiobtn.checked = true;
        }
        else{
            radiobtn = document.getElementById('star-5');
            radiobtn.checked = true;
        }
        
    }
}

function InsertDirectItineraryAPI(userid){
    console.log(userid);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            InsertDirectItinerary(this);
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    

    request.open("GET", "api/review/ReadReview.php?userid=" + userid , true);
    request.send();
}
function InsertDirectItinerary(obj){
    console.log(obj);
    itineraryid = sessionStorage.getItem('itineraryid');
    message = sessionStorage.getItem('message');
    comments = sessionStorage.getItem('comments');
    userid = sessionStorage.getItem('userid');
    console.log(userid);
    rate = sessionStorage.getItem('rate');
    var reviewid = 0;
    console.log(reviewid);
    var response_json = JSON.parse(obj.responseText);
    var paymentRecords = response_json["records"];
    console.log(paymentRecords);
    var count = 0;
    var itinerary_details = sessionStorage.getItem('itinerary_details');
    console.log(itinerary_details);
    for(element of paymentRecords){
        console.log(element['itineraryid']);
        console.log(element['ReviewdetailsID']);
        console.log(element);
        if(element['itineraryid'] == itineraryid && element['reviewid'] != null){
            reviewid = element['reviewid'];
            sessionStorage.setItem('reviewid', reviewid);
            ReviewdetailsID = element['ReviewdetailsID'];
            sessionStorage.setItem('ReviewdetailsID',ReviewdetailsID);
            count += 1;


        }
        
    }
    if(reviewid == 0){
        reviewid += 1;
        console.log(reviewid);
        ReviewID = sessionStorage.setItem('reviewid',reviewid);
        reviewid = sessionStorage.getItem('reviewid',ReviewID);
        console.log(reviewid);
        var date = Date(Date.now()); 
        insertRecords(reviewid,userid,itineraryid, rate, '',date, message);
        
    }
    if(reviewid > 0 && (ReviewdetailsID == '' || ReviewdetailsID == null) && (itinerary_details == '' || itinerary_details == null)){
        callReviewDetailsAPI(ReviewdetailsID,reviewid,itinerary_details, rate, comments);
        console.log("HERE WE GO AGN");
    }
    else{
        reviewid = sessionStorage.getItem('reviewid');
        ReviewdetailsID = sessionStorage.getItem('ReviewdetailsID');
        result = UpdateItineraryReviewAPI(rate,comments,reviewid,itinerary_details,ReviewdetailsID);
        console.log("here we go ");
    }
    
}
function UpdateItineraryReviewAPI(ActivityRate,comments,reviewid,itinerary_details){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert("Successfully Reviewed...!");
        }
    }

    var url = `http://localhost/wadproject/api/review/UpdateIndividualItinerary.php?ActivityRate=${ActivityRate}&comments=${comments}&reviewid=${reviewid}&itinerary_details=${itinerary_details}&ReviewdetailsID=${ReviewdetailsID}`; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();
}
function StartReview(paymentid){
    console.log(paymentid);
    var url = `NewReviewPage.html?paymentid=` + paymentid;
    location.href = url;
    console.log("here");
}
function ReviewIndividualActivity(itineraryid, itinerary_details){
    console.log(itinerary_details);
    sessionStorage.setItem('itinerary_details',itinerary_details);
    console.log(itineraryid);
    console.log(itinerary_details);
    htmlTable = '';
    htmlTable += `
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Review Your Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                            <div id="form">
                            
                                <textarea id="msg" name="message" placeholder="Comments" rows="4" cols="60"></textarea>
                                <div class="stars">
                                    <input class="star star-5" id="star-5" value = '5' type="radio" name="star"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" value = '4'type="radio" name="star"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" value = '3' type="radio" name="star"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" value = '2' type="radio" name="star"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" value = '1'type="radio" name="star"/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>

                            </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onClick="check_empty(${itineraryid}, ${itinerary_details})" id="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    `;
    document.getElementById('insertion').innerHTML = htmlTable;

}
function ReviewByItinerary(itineraryid, userid){
    sessionStorage.setItem('itinerary_details',userid);
    console.log(itinerary_details);
    htmlTable = '';
    htmlTable += `<div id="popupContact">
    <div id="form">
    <button onclick ="div_hide()">Close </button>
    <h2>Review for This Activity</h2>
    <hr>
    <div class="stars">
    <input class="star star-5" id="star-5" value = '5' type="radio" name="star"/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" value = '4'type="radio" name="star"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3" value = '3' type="radio" name="star"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" value = '2' type="radio" name="star"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" value = '1'type="radio" name="star"/>
    <label class="star star-1" for="star-1"></label>
    </div>
    <textarea id="msg" name="message" placeholder="Comments"></textarea>
    <button onClick="check_empty(${itineraryid}, ${itinerary_details})" id="submit">Send</button>
    </div>
    </div>
    <!-- Popup Div Ends Here -->
    </div>`;
    document.getElementById('insertion').innerHTML = htmlTable;

}
var activityRating = 0;
function check_empty(itineraryid, itinerary_details) {
    console.log("here");
    itinerary_details = sessionStorage.getItem("itinerary_details");
    console.log(itinerary_details);
    userid = sessionStorage.getItem("userid");
    sessionStorage.setItem("itineraryid",itineraryid);
    var nodes = document.getElementsByName('star');
    console.log(nodes);
    var comments = document.getElementById('msg').value;
    var message = document.getElementById('msg').value;
    sessionStorage.setItem('message',message);
    sessionStorage.setItem('comments',comments);
    for(i = 0; i< nodes.length; i++){
        
        console.log(activityRating);
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
        InsertDirectItineraryAPI(userid);
        
    }
    
    

}
    //Function To Display Popup
function div_show() {
    document.getElementById('insertion').style.display = "block";
}
    //Function to Hide Popup
function div_hide(){
    var userid = sessionStorage.getItem('userid');
    var paymentid = sessionStorage.setItem('paymentid');
    paymentid = sessionStorage.getItem(paymentid);
    console.log(paymentid)
    var url = `NewReviewPage.html?=`+ paymentid;
    location.href = url;
}
function hide_div(paymentid){
    var userid = sessionStorage.getItem('userid');
    var paymentid = sessionStorage.getItem('paymentid');
    var url = `NewReviewPage.html?=`+ paymentid;
    location.href = url;
}
function division_hide(){
    var userid = sessionStorage.getItem('userid');
    var paymentid = sessionStorage.getItem('paymentid');
    var url = `NewReview.html`;
    location.href = url;
}

function ViewIndividualRatings(itineraryid,itinerary_details){
    //Create an API that combines itinerary table, itinerary_details table, reviews table & reviews detaisl table
}
function RedirectNew(){
    var paymentid = sessionStorage.getItem('paymentid');
    var url = `NewReviewPage.html?=`+ paymentid;
    location.href = url;
}
function RedirectToProfile(){
    var url = `ProfilePage.php`;
    location.href = url;
}