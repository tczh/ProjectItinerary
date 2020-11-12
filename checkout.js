// display all the add to cart items
function display_store() {
    // userid = sessionStorage.getItem('userid');
    console.log("yo");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response_json = JSON.parse(this.responseText);
            var all_records = response_json.records;

            var str = ``;
            var store_name = [];

            //need to close the div

            for (record of all_records) {
                var itineraryowner = record['itineraryowner'];
                var itineraryid = record['itineraryid'];
                if (store_name.includes(itineraryowner) == false && store_name.length == 0) {

                    store_name.push(itineraryowner);

                    str += `
                    <div class="container" style="margin-top:10px; background-color: white; ">
                        <div class="row" style="border-bottom: gray solid 1px ;">
                            <div class="col-8" style="padding: 10px; ">
                            <input type="checkbox" class="store" id="${itineraryowner}" onclick="selected()" value="0">&nbsp&nbsp&nbsp
                            <label for="${itineraryowner}"><i>${itineraryowner}'s itinerary</i></label>
                            </div>
                        </div>

                    
                    <div class="row">
                        <div class="col-8" style="padding: 10px;">
                            <input type="checkbox" class= "${itineraryowner}" id="${itineraryid}" value=${record['price']} onclick="itinerary_select(${itineraryid})"> 
                            &nbsp&nbsp&nbsp
                            <img src="images/${record['thumbnail']}" width="150px" height="150px" style="clip-path: square(60px at center);">
                            <span>&nbsp&nbsp&nbsp${record['tourtitle']}</span>
                        </div>

                        <div class="col-2" style="padding: 70px 10px 70px 10px;">
                            ${record['price']}
                        </div>
                        <div class="col-2" style="padding: 70px 10px 70px 10px;">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="delete_records(${itineraryid})">Delete</button>
                        </div>
                    </div>`;


                } else if (store_name.includes(itineraryowner) == false && store_name.length != 0) {
                    store_name.push(itineraryowner);

                    str += `
                    </div>
                    <div class="container" style="margin-top:10px; background-color: white; ">
                        <div class="row" style="border-bottom: gray solid 1px ;">
                            <div class="col-8" style="padding: 10px; ">
                            <input type="checkbox" class="store" id="${itineraryowner}" onclick= "selected()" value="0">&nbsp&nbsp&nbsp
                            <label for="${itineraryowner}"><i>${itineraryowner}'s itinerary</i></label>
                            </div>
                        </div>

                    
                    <div class="row">
                        <div class="col-8" style="padding: 10px;">
                            <input type="checkbox" class= "${itineraryowner}" id="${itineraryid}" value=${record['price']} onclick="itinerary_select(${itineraryid})">
                            &nbsp&nbsp&nbsp
                            <img src="images/${record['thumbnail']}" width="150px" height="150px" style="clip-path: square(60px at center);">
                            <span>&nbsp&nbsp&nbsp${record['tourtitle']}</span>
                            
                        </div>

                        <div class="col-2" style="padding: 70px 10px 70px 10px;">
                            ${record['price']}
                        </div>
                        <div class="col-2" style="padding: 70px 10px 70px 10px;">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="delete_records(${itineraryid})">Delete</button>
                        </div>
                    </div>`;


                } else {
                    str += `
                    <div class="row">
                        <div class="col-8" style="padding: 10px;">
                            <input type="checkbox" class="${itineraryowner}" id="${itineraryid}" value=${record['price']} onclick="itinerary_select(${itineraryid})">
                            &nbsp&nbsp&nbsp
                            <img src="images/${record['thumbnail']}" width="150px" height="150px" style="clip-path: square(60px at center);">
                            <span>&nbsp&nbsp&nbsp${record['tourtitle']}</span>
                        </div>

                        <div class="col-2" style="padding: 70px 10px 70px 10px;">
                            ${record['price']}
                        </div>
                        <div class="col-2" style="padding: 70px 10px 70px 10px;">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="delete_records(${itineraryid})">Delete</button>
                        </div>
                    </div>`;

                }

            }

            str += "</div>";

            document.getElementById("all_storeitems").innerHTML = str;


        }

    }

    //var url = "api/Cart/Cart_itinerary_details.php?userid=" + userid; //need to change the username based on the session later!
    var url = "api/Cart/Cart_itinerary_details.php?userid=" +userid ;
    request.open("GET", url, true);
    request.send();


}

// To get all the cart stallnames (not really needed for now)
var all_store = [];

function all_stores() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response_json = JSON.parse(this.responseText);
            var all_records = response_json.records;


            for (var record of all_records) {
                var store = record["itineraryowner"];

                if (all_store.includes(store) == false) {

                    all_store.push(store);
                }
            }
        }

    }

    var url = "api/Cart/Cart_itinerary_details.php?userid=" + userid; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();

}


// select all store item when click on the store
function selected() {

    var checkbox = document.getElementsByClassName('store')
    for (var box of checkbox) {
        var idname = box.getAttribute("id");
        // console.log(idname);
        var all_item = document.getElementsByClassName(idname);
        if (box.checked == true) {
            for (item of all_item) {
                // item.setAttribute("checked", "checked");
                item.checked = true;
            }
        } else {
            for (var item of all_item) {
                // item.removeAttribute('checked');
                item.checked = false;
            }
        }
    }


    var all_itineraries = document.getElementById('all_itineraries');
    var all_checkbox = document.getElementsByTagName('input');
    var count_checkbox = all_checkbox.length;
    var counter = 0;

    for (var c of all_checkbox) {
        if (c.checked == false) {
            console.log("hi");
            all_itineraries.checked = false;
        } else {
            counter += 1;
        }
    }

    if (count_checkbox - 1 == counter) {
        all_itineraries.checked = true;
    }

    total_number_itinerary();
    total_value();
}

// select all when click on all itinerary
function select_all() {
    var all_itineraries = document.getElementById("all_itineraries");
    var all_checkbox = document.getElementsByTagName("input");

    // for (var checkbox of all_checkbox) {
    //     console.log(checkbox);
    //     console.log("hi");
    // }

    if (all_itineraries.checked == true) {
        for (var checkbox of all_checkbox) {
            // checkbox.setAttribute("checked", "checked");
            checkbox.checked = true;
        }
    } else {
        for (var checkbox of all_checkbox) {
            // checkbox.removeAttribute('checked');
            checkbox.checked = false;
        }
    }
    total_number_itinerary();
    total_value();

}


// button for individual item
function itinerary_select(itineraryid) {
    var checkbox = document.getElementById(itineraryid);
    if (checkbox.checked == true) {
        checkbox.setAttribute("checked", "checked")
    } else {
        checkbox.removeAttribute('checked');
    }

    var classname = document.getElementById(itineraryid).getAttribute("class");
    var class_nodes = document.getElementsByClassName(classname);
    var number_nodes = class_nodes.length;
    var count = 0;
    var store_checkbox = document.getElementById(classname);
    var all_itineraries = document.getElementById('all_itineraries');

    for (node of class_nodes) {

        if (node.checked == false) {
            // console.log("hi");
            store_checkbox.checked = false;
            all_itineraries.checked = false;
        } else {
            count += 1;
        }
    }
    if (count == number_nodes) {
        store_checkbox.checked = true;
    }


    var all_checkbox = document.getElementsByTagName('input');
    var count_checkbox = all_checkbox.length;
    var counter = 0;

    for (var c of all_checkbox) {
        if (c.checked == false) {
            // console.log("hi");
            all_itineraries.checked = false;
        } else {
            counter += 1;
        }
    }

    if (count_checkbox - 1 == counter) {
        all_itineraries.checked = true;
    }

    total_number_itinerary();
    total_value();

}


function total_number_itinerary() {
    var count = 0;
    var all_itineraries = document.getElementsByTagName("input");
    for (i = 1; i < all_itineraries.length; i++) {
        // console.log(all_itineraries[i])
        var classname = all_itineraries[i].getAttribute("class");
        if (classname != "store" && all_itineraries[i].checked == true) {
            count += 1;

        }
    }
    document.getElementById("total_number").innerHTML = count;

}



var checkout_amount = 0;

function total_value() {
    var count = 0;
    var all_itineraries = document.getElementsByTagName("input");
    for (i = 1; i < all_itineraries.length; i++) {
        // console.log(all_itineraries[i])
        var classname = all_itineraries[i].getAttribute("class");
        if (classname != "store" && all_itineraries[i].checked == true) {
            var price = all_itineraries[i].getAttribute("value");
            count += Number(price);
        }
    }

    var count = count.toFixed(2);
    // console.log(count);
    document.getElementById("total_amount").innerHTML = count;

    sessionStorage.setItem("checkout_amount", count);
    var checkout_amount = sessionStorage.getItem("checkout_amount");
    // console.log(checkout_amount);

}


function delete_records(itineraryid) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // var checked=[];

            location.reload(true);
        }
    }

    var url = "api/Cart/Cart_delete.php?userid="+ userid + "&itineraryid=" + itineraryid; //need to change the username based on the session later!
    request.open("GET", url, true);
    request.send();

}





function checkout_button() {

    // console.log("hello");
    userid = sessionStorage.getItem('userid'); //to change and retrieve the number from the session. 
    // var count = 0;


    var checkout_items = {};

    var all_itineraries = document.getElementsByTagName("input");
    for (i = 1; i < all_itineraries.length; i++) {
        var checkout_detail = {};

        var classname = all_itineraries[i].getAttribute("class");
        if (classname != "store" && all_itineraries[i].checked == true) {
            var itineraryid = all_itineraries[i].getAttribute("id");
            var price = all_itineraries[i].getAttribute("value");
            checkout_detail['price'] = price;
            console.log(itineraryid);

            checkout_items[itineraryid] = checkout_detail;

        }
    }
    

    sessionStorage.setItem('checkout_items', JSON.stringify(checkout_items));
    sessionStorage.setItem("userid", userid);


}



