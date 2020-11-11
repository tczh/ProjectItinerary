function onLoadData(){
    var userid = document.getElementById('userid').innerText.trim(); 
    var itineraryid = document.getElementById('itineraryid').innerText.trim(); 
    var check = document.getElementById('check').innerText.trim(); 
    console.log(check);
    showHeader(userid, itineraryid, check);
    showDetails(userid, itineraryid, check)

    
}

function showHeader(userid, itineraryid, check){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            itineraryowner = responses["records"][0]["itineraryowner"];
            tourtitle = responses["records"][0]["tourtitle"];
            tourcategory = responses["records"][0]["tourcategory"];
            country = responses["records"][0]["country"];
            season = responses["records"][0]["season"];
            thumbnail = responses["records"][0]["thumbnail"];
            str = "<img src='" + thumbnail+"' style='max-width:100%;max-height:100%;opacity:100%')'>";
            document.getElementById("headerimg").innerHTML = str;
            str =`
                <h1>${tourtitle}</h1>
                <h5>Experience ${country} in <span class="font-italic">${season}</span></h5>
                <h6>Itinerary created by ${itineraryowner}</h6>
            `;
            if(season == "winter"){
                document.body.style.backgroundImage = "url('winter.jpg')"
            }
            else if(season=="fall"){
                document.body.style.backgroundImage = "url('fall.jpg')"
            }
            else if(season=="spring"){
                document.body.style.backgroundImage = "url('spring.jpg')"
            }
            else if(season=="summer"){
                document.body.style.backgroundImage = "url('summer.jpg')"
            }
            
            document.getElementById("headertext").innerHTML = str;
            
        }
        else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    };
    
    if(check=='1'){
        request.open("GET", "api/itinerarydetails/getItineraryHeader.php?userid=" + userid + "&itineraryid=" + itineraryid, true);
    }
    if(check=='2'){
        request.open("GET", "api/itinerarydetails/getBoughtItineraryHeader.php?userid=" + userid + "&itineraryid=" + itineraryid, true);
    }
    
    request.send();
}

function showDetails(userid, itineraryid, check){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responses = JSON.parse(this.responseText);
            dayList =[]
            str1 = `
                <h3 class="mb-3 p-1" style="background:white;border-radius: 25px;opacity:90%">Overview <i class="fa fa-map-marker" style="color:red"></i></h3>
                <div class="list-group" id="list-tab" role="tablist">
            `;
            str2=`<div class="tab-content" id="nav-tabContent">`;
            
            count=0;
            console.log(responses);
            for(record of responses['records']){
                if(!dayList.includes(record['daynumber']) && count ==0){
                    dayList.push(record['daynumber'])
                    str1 +=`<a class="list-group-item list-group-item-action active" id="day${record['daynumber']}" data-toggle="list" href="#list-day${record['daynumber']}" role="tab" aria-controls="day${record['daynumber']}">Day ${record['daynumber']}</a>`
                    count =1;
                    str2+=`<div class="tab-pane fade show active" id="list-day${record['daynumber']}" role="tabpanel" aria-labelledby="day${record['daynumber']}">
                        <h3 class="mb-3 p-1" style="background:white;border-radius: 25px;opacity:90%">Day ${record['daynumber']}</h3>
                        </div>`;
                }
                else if(!dayList.includes(record['daynumber']) && count ==1){
                    dayList.push(record['daynumber']);
                    str1 +=`<a class="list-group-item list-group-item-action" id="day${record['daynumber']}" data-toggle="list" href="#list-day${record['daynumber']}" role="tab" aria-controls="day${record['daynumber']}">Day ${record['daynumber']}</a>`;
                    str2+=`<div class="tab-pane fade" id="list-day${record['daynumber']}" role="tabpanel" aria-labelledby="day${record['daynumber']}">
                        <h3 class="mb-3 p-1" style="background:white;border-radius: 25px;opacity:90%">Day ${record['daynumber']}</h3>
                        </div>`;
                }
                

            }
            str1+= "</div>";
            str2+=`</div>`;
            document.getElementById("overview").innerHTML=str1;
            document.getElementById("content").innerHTML=str2;

            dayList = [];
            count=0;
            for(record of responses['records']){
                if(parseFloat(record['starttime']) < 12){
                    day = "Morning";
                    dayicon = `<i class="fa fa-sun-o" style="color:#F28C38 ;position: absolute;clip: rect(0px, 16px, 8px, 0px);"></i>`;
                }
                else if (parseFloat(record['starttime']) > 12 && parseFloat(record['starttime']) < 19){
                    day = "Afternoon";
                    dayicon = `<i class="fa fa-sun-o" style="color:#F28C38"></i>`;
                }
                else{
                    day ="Night";
                    dayicon = `<i class="fa fa-moon-o" style="color:#31566d"></i>`;
                }

                if(!dayList.includes(record['daynumber'])){
                    dayList.push(record['daynumber']);
                    timeline = document.createElement('ul');
                    timeline.setAttribute("id", `timeline-${record['daynumber']}`);
                    timeline.setAttribute("class", `timeline`);
                    document.getElementById(`list-day${record['daynumber']}`).appendChild(timeline);
                    item = document.createElement('li');
                    item.setAttribute("id", `timeline-list-${count}`);
                    item.setAttribute("class", `timeline-item bg-white rounded ml-3 p-4 shadow`);
                    document.getElementById(`timeline-${record['daynumber']}`).appendChild(item);
    
                    str= `
                        <div class="row">
                            <div class="col col-sm-10">
                                <div class="timeline-arrow"></div>
                                <h2 class="h5 mb-0">${record['activity']}</h2>
                                <span class="small text-gray"><i class="fa fa-map-marker mr-1"></i>${record['location']}</span> <br>
                                <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i>${record['starttime']} - ${record['endtime']} (${day})</span>
                                <p class="text-small mt-2 font-weight-light">
                                    ${record['description']}
                                </p>
                            </div>
                            <div class="col col-sm-1 vl"></div>
                            <div class="col col-sm-1">
                                ${dayicon}
                            </div>
                        </div>`;
                    document.getElementById(`timeline-list-${count}`).innerHTML = str;
                    count++;
                }
                else{
                    
                    item = document.createElement('li');
                    item.setAttribute("id", `timeline-list-${count}`);
                    item.setAttribute("class", `timeline-item bg-white rounded ml-3 p-4 shadow`);
                    document.getElementById(`timeline-${record['daynumber']}`).appendChild(item);
                    str= `
                        <div class="row">
                            <div class="col col-sm-10">
                                <div class="timeline-arrow"></div>
                                <h2 class="h5 mb-0">${record['activity']}</h2>
                                <span class="small text-gray"><i class="fa fa-map-marker mr-1"></i>${record['location']}</span> <br>
                                <span class="small text-gray"><i class="fa fa-clock-o mr-1"></i>${record['starttime']} - ${record['endtime']} (${day})</span>
                                <p class="text-small mt-2 font-weight-light">
                                    ${record['description']}
                                </p>
                            </div>
                            <div class="col col-sm-1 vl"></div>
                            <div class="col col-sm-1">
                                ${dayicon}
                            </div>
                        </div>`;
                    document.getElementById(`timeline-list-${count}`).innerHTML = str;
                    count++;
                }

            }
            
        }
        else if (this.readyState == 4 &&  this.status == 404) {
            alert("Error reading file");
            return;
        }
    }

    if(check=='1'){
        request.open("GET", "api/itinerarydetails/getItineraryDetails.php?userid=" + userid + "&itineraryid=" + itineraryid, true);
    }
    if(check=='2'){
        request.open("GET", "api/itinerarydetails/getBoughtItineraryDetails.php?userid=" + userid + "&itineraryid=" + itineraryid, true);
    }

    request.send();
}