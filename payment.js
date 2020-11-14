var checkout_items = JSON.parse(sessionStorage.getItem('checkout_items'));
var userid = sessionStorage.getItem("userid");

console.log(checkout_items);

receipt_str = `"ItemDetails": [`;
receipt_total = "";
receipt_tax = "";
var total_chargable = "";

function purchasesby_id() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var response_json = JSON.parse(this.responseText);
            var all_records = response_json.records;

            console.log(all_records);
            var total_price = 0;
            var count = 0;
            var str = "";

            for (var record of all_records) {
                var itineraryid = record['itineraryid'];
                if (itineraryid in checkout_items && record['userid']==userid) {
                    count++;
                    var price = record['price'];
                    total_price += Number(price);
                    var tourtitle = record['tourtitle'];
                    var itineraryowner = record['itineraryowner'];
                    checkout_items[itineraryid]['tourtitle'] = tourtitle;
                    checkout_items[itineraryid]['itineraryowner'] = itineraryowner;


                    str += `
                        <div class="row">
                            <div class="col" style="text-indent: 15px;">
                                - ${tourtitle}
                            </div>
                            <div class="col text-center">
                                ${price}
                            </div>
                        </div>   `;


                    receipt_str += ` 
                    {
                        "ItemCode": "${itineraryid}",
                        "ItemName": "${tourtitle}",
                        "ItemQty": 1,
                        "ItemUnit": "pcs",
                        "ItemPrice": ${price},
                        "ItemTotal": ${price}
                        
                    },`;
                }
            }
            receipt_str = receipt_str.substring(0, receipt_str.length - 1)
            receipt_str += `],`;

            total_price = Number(total_price).toFixed(2);
            receipt_total = total_price;
            receipt_tax = total_price * 0.07;
            total_chargable = Number(total_price) + Number(receipt_tax);

            document.getElementById('all_purchases').innerHTML = str;
            document.getElementById("summary").innerHTML = `<div class="col">Total (${count} Products)</div><div class="col text-center">${total_price}</div>`

        }

    }

    var url = "api/Cart/Cart_itinerary.php"; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();


}



function list_of_year() {
    var years = [2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032];
    var str = `
    <select name="year" id="year" class="form-control">
                        <option selected="selected" disabled selected hidden>Year</option>
    `;
    for (year of years) {
        str += `
            <option value=${year}>${year}</option>
        `;
    }
    str += "</select>"
    document.getElementById("year").innerHTML = str;
}



var months = {
    'January': 1,
    'Februrary': 2,
    'March': 3,
    'April': 4,
    'May': 5,
    'June': 6,
    'July': 7,
    'August': 8,
    'September': 9,
    'October': 10,
    'November': 11,
    'December': 12
};

function list_of_month() {
    var months = {
        'January': 1,
        'Februrary': 2,
        'March': 3,
        'April': 4,
        'May': 5,
        'June': 6,
        'July': 7,
        'August': 8,
        'September': 9,
        'October': 10,
        'November': 11,
        'December': 12
    };
    var str = `
    <select name="month" id="month" class="form-control">
                        <option selected="selected" disabled selected hidden>Month</option>
    `;
    for (month in months) {
        str += `
            <option value=${month}>${month}</option>
        `;
    }
    str += "</select>"
    document.getElementById("month").innerHTML = str;
}





function submit_payment() {
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var cardnumber = document.getElementById('cardnumber').value;
    var cardholder = document.getElementById('cardholder').value;
    var year = document.getElementById('year').value;
    var month = document.getElementById('month').value;
    var cvv = document.getElementById('cvv').value;
    var fullname = firstname + " " + lastname;
    var month_number = months[month];
    var current_date = new Date();
    var current_month = current_date.getMonth();
    var current_year = current_date.getFullYear();



    var count = 0;

    if (isNaN(firstname)) {
        count += 1;
        document.getElementById("firstname").style.backgroundColor = "white";
    } else {
        document.getElementById("firstname").placeholder = "Please enter a valid first name";
        document.getElementById("firstname").value = "";
        document.getElementById("firstname").style.backgroundColor = "rgb(255, 218, 218)";
    }

    if (isNaN(lastname)) {
        count += 1;
        document.getElementById("lastname").style.backgroundColor = "white";
    } else {
        document.getElementById("lastname").placeholder = "Please enter a valid lastname";
        document.getElementById("lastname").value = "";
        document.getElementById("lastname").style.backgroundColor = "rgb(255, 218, 218)";

    }

    if (isNaN(cardholder)) {
        count += 1;
        document.getElementById("cardholder").style.backgroundColor = "white";
    } else {
        document.getElementById("cardholder").placeholder = "Please enter a valid cardholder name";
        document.getElementById("cardholder").value = "";
        document.getElementById("cardholder").style.backgroundColor = "rgb(255, 218, 218)";

    }

    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (email.match(mailformat)) {
        count += 1;
        document.getElementById("email").style.backgroundColor = "white";
    } else {
        document.getElementById("email").placeholder = "Please enter a valid email address";
        document.getElementById("email").value = "";
        document.getElementById("email").style.backgroundColor = "rgb(255, 218, 218)";

    }

    var visa_cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    var master_cardno = /^(?:5[1-5][0-9]{14})$/;
    var amex_cardno = /^(?:3[47][0-9]{13})$/;
    if (cardnumber.match(amex_cardno)) {
        count += 1;
        document.getElementById("cardnumber").style.backgroundColor = "white";

    } else if (cardnumber.match(visa_cardno)) {
        count += 1;
        document.getElementById("cardnumber").style.backgroundColor = "white";
    } else if (cardnumber.match(master_cardno)) {
        count += 1;
        document.getElementById("cardnumber").style.backgroundColor = "white";
    } else {
        document.getElementById("cardnumber").placeholder = "Please enter a valid card number";
        document.getElementById("cardnumber").value = "";
        document.getElementById("cardnumber").style.backgroundColor = "rgb(255, 218, 218)";

    }

    if (cvv.length == 3 && isNaN(cvv) == false) {
        count += 1
        document.getElementById("cvv").style.backgroundColor = "white";

    } else {
        document.getElementById("cvv").placeholder = "Invalid";
        document.getElementById("cvv").value = "";
        document.getElementById("cvv").style.backgroundColor = "rgb(255, 218, 218)";

    }



    if (year == "Year") {
        document.getElementById('year').style.backgroundColor = "rgb(255, 218, 218)";

    } else {
        count += 1;
        document.getElementById("year").style.backgroundColor = "white";
    }


    if (month == "Month") {
        document.getElementById('month').style.backgroundColor = "rgb(255, 218, 218)";

    } else {
        count += 1;
        document.getElementById("month").style.backgroundColor = "white";
    }



    if (year != "Year" && month != "Month" && current_year >= year && current_month > months[month]) {
        document.getElementById('year').style.backgroundColor = "rgb(255, 218, 218)";
        document.getElementById('month').style.backgroundColor = "rgb(255, 218, 218)";
    }
    else{
        count+=1;
        document.getElementById("year").style.backgroundColor = "white";
        document.getElementById("month").style.backgroundColor = "white";
    }


    if (count == 9) {
        console.log(checkout_items);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {


            }
        }

        var url = "api/Cart/Cart_payment.php?billingemail=" + email; //need to change the username based on the session later!
        request.open("GET", url, true);
        request.send();



        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var response_json = JSON.parse(this.responseText);
                var all_records = response_json.records;
                var paymentid = all_records[0]['paymentid'];
                var datebought = all_records[0]['datebought'];
                date = datebought.split(" ");

                var str = `
                {
                    "StoreDetails": {
                        "Name": "Tim's Travel Agency",
                        "LogoUrl": "https://cdn0.iconfinder.com/data/icons/octicons/1024/globe-512.png",
                        "TaxDetails": "",
                        "Phone": "+65 6565 7799",
                        "ReceiptHeader": "Welcome to Tim's Travel Agency",
                        "ReceiptFooter": "Thanks for your purchasing with us!!!"
                    },
            
            
                    "CustomerDetails": {
                        "Name": "${fullname}",
                        "Phone": "" ,
                        "CountryCode": "",
                        "Email": {
                            "recepientEmail": "${email}",
                            "subject": "Here is the receipt for your recent purchase with Tim's Travel Agency",
                            "fromEmail": "receipts@oxebox.com",
                            "fromName": "Tim's Travel Agency",
                            "replyToEmail": "${email}"
                        }
                    },
            
                    "BillingDetails": {
                        "BillReceiptID": "${paymentid}",
                        "TransactionDate": "${date[0]}",
                        "TransactionTime": "${date[1]}",
                        
                        ${receipt_str}
                    
                        "Taxes": [{
                            "Name": "SGST",
                            "Total": ${receipt_tax},
                            "Percent": 7
                        }
                    ],
                    "SubTotal": ${receipt_total},
                    "TotalBillAmount": ${total_chargable}  
                },

                "StorePromotions": {
                    "OfferImage": "https://www.awcberlin.org/wp-content/uploads/2019/02/ce-travel.jpg",
                    "facebook_link": "#",
                    "twitter_link": "#",
                    "instagram_link": "#",
                    "youtube_link": "#"
                }
            }  `;

                var parse = JSON.parse(str);
                var data = JSON.stringify(parse);

                console.log(parse);

                console.log(data);

                var xhr = new XMLHttpRequest();


                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var response_json = JSON.parse(this.responseText);

                        console.log(this.responseText);
                        var all_records = response_json.records;
                        console.log(all_records);

                    }
                }

                xhr.open("POST", "https://oxebox-generate-a-new-oxebox-bill-receipt-v1.p.rapidapi.com/generateNewBill");
                xhr.setRequestHeader("x-rapidapi-host", "oxebox-generate-a-new-oxebox-bill-receipt-v1.p.rapidapi.com");
                xhr.setRequestHeader("x-rapidapi-key", "d643204bd9msh458b9d90eaba4c0p1c0fdajsne466e250a060");
                xhr.setRequestHeader("content-type", "application/json");
                xhr.setRequestHeader("accept", "application/json");


                xhr.send(data);




                for (item in checkout_items) {

                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {

                        }
                    }
                    console.log(paymentid);
                    console.log(userid);
                    console.log(checkout_items[item]['itineraryowner']);
                    console.log(email);
                    ispaid = 1;
                    console.log(ispaid);
                    var url ="api/Cart/Cart_buy.php?paymentid=" + paymentid + "&userid=" + userid + "&itineraryowner=" + checkout_items[item]['itineraryowner'] + "&itineraryid=" + item + "&ispaid=" + ispaid + "&billingemail=" + email; //need to change the username based on the session later!
                    //var url = "api/Cart/Cart_buy.php?paymentid=" + paymentid + "&userid=" + userid + "&itineraryowner=" + checkout_items[item]['itineraryowner'] + "&itineraryid=" + item + "&ispaid=1&billingemail=" + email; //need to change the username based on the session later!
                    request.open("GET", url, true);
                    request.send();

                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {


                        }
                    }

                    var url = "api/Cart/Cart_delete.php?userid=" + userid + "&itineraryid=" + item; //need to change the username based on the session later!
                    request.open("GET", url, true);
                    request.send();

                    ///////////////////////////////////////////////////////////////////


                    // console.log(item);
                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            insert_function(this);

                        }
                    }
                    console.log(item);
                    var url = "api/Cart/itinerary_purchased.php?itineraryid=" + item;
                    //var url = "api/Cart/itinerary_purchased.php?itineraryid=" + item;" //need to change the username based on the session later!
                    request.open("GET", url, true);
                    request.send();

                    ///////////////////////////////////////////

                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            insert_activities(this);
                            // var response_json = JSON.parse(this.responseText);
                            // console.log(response_json);


                        }
                    }

                    var url = "api/Cart/itinerary_activities.php?itineraryid=" + item; 
                    //var url = "api/Cart/itinerary_activities.php?itineraryid=" + item; "//need to change the username based on the session later!
                    request.open("GET", url, true);
                    request.send();





                    ////////////////////////////////////////////////////////////////

                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {


                        }
                    }

                    var url = "api/Cart/Cart_delete.php?userid=" + userid + "&itineraryid=" + item; //need to change the username based on the session later!
                    request.open("GET", url, true);
                    request.send();



                }


            }
        }
        var urlY = "api/Cart/Cart_paymentid.php";
        //var url = "api/Cart/Cart_paymentid.php";
        request.open("GET", urlY, true);
        request.send();

        document.getElementById("insert_modal").innerHTML = `
        
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Payment Successful</h5>
            </div>
            <div class="modal-body">
                Thank you for shopping at Tim's Travel Agency. Your receipt will be spent to your billing email address. 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Back to home page</a></button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='checkout.html'">Go to My Cart</a></button>
            </div>
          </div>
        </div>
      </div>`;




    } else {
        document.getElementById("insert_modal").innerHTML = `
        
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Payment Unsuccessful</h5>
            </div>
            <div class="modal-body">
              Invalid fills!! Please make the necessary amendments.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>`;


    }

}



function insert_function(xml) {


    var response_json = JSON.parse(xml.responseText);
    console.log(response_json);
    console.log(response_json[0]);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

        }
    }

    var url = "api/Cart/itinerary_insert.php?userid=" + userid + "&itineraryid=" + response_json.records[0].itineraryid + "&itineraryowner=" + response_json.records[0].itineraryowner + "&tourtitle=" + response_json.records[0].tourtitle + "&tourcategory=" + response_json.records[0].tourcategory + "&country=" + response_json.records[0].country + "&price=" + response_json.records[0].price + "&thumbnail=" + response_json.records[0].thumbnail + "&season=" + response_json.records[0].season; //need to change the username based on the session later!
    //var url = "api/Cart/itinerary_insert.php?userid=" + userid + "&itineraryid=" + response_json.records[0].itineraryid + "&itineraryowner=" + response_json.records[0].itineraryowner + "&tourtitle=" + response_json.records[0].tourtitle + "&tourcategory=" + response_json.records[0].tourcategory + "&country=" + response_json.records[0].country + "&price=" + response_json.records[0].price + "&thumbnail=" + response_json.records[0].thumbnail + "&season=" + response_json.records[0].season; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();


}


function insert_activities(xml) {

    var response_json = JSON.parse(xml.responseText);
    var all_records = response_json.records;    

    for (record of all_records) {

        console.log(record.itineraryid);
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {                

            }
        }

        var url = "api/Cart/insert_activities.php?userid=" + userid + "&detailsid=" + record.detailsid+ "&itineraryid=" + record.itineraryid + "&itineraryowner=" + record.itineraryowner + "&daynumber=" + record.daynumber + "&location=" +record.location + "&activity=" + record.activity + "&activitynumber=" + record.activitynumber + "&description=" + record.description + "&starttime=" + record.starttime + "&endtime="+ record.endtime; //need to change the username based on the session later!

        request.open("GET", url, true);
        request.send();

        console.log(url);

    }

    
}