var country = sessionStorage.getItem('country');

if(country != '' || country != null){
    console.log("Entered here");
    RetrieveAPI(country)
}
else{
    console.log("Error");
}
function RetrieveAPI(country) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            retrieveAllFeedbackJSON(this);
            
        
        } else if (this.readyState == 4 &&  this.status == 404) {
            console.log("No country exist");
        }
    };
    

    request.open("GET", "http://localhost/ProjectItinerary/api/Statistics/ViewStatistics.php?Country=" + country , true);
    console.log(request);
    request.send();
}
function retrieveAllFeedbackJSON(obj){
    country = sessionStorage.getItem('country');
    var tableHTML = '';
    var response_json = JSON.parse(obj.responseText);
    
    var paymentRecords = response_json["records"];
    console.log(paymentRecords);
    
    //tableHTML += 'header: ["Month", "Traffic"], rows:';
    var data = {
        header: ["Month", "Traffic"],
        rows: []
    };
    for(element of paymentRecords){
        data.rows.push([element['month'], element['count']]);
    
    }
    
    data = tableHTML.substring(0, tableHTML.length - 1);
    //tableHTML += `}`;
    console.log(data);
    var chart = anychart.bar();
    chart.data(data);
    chart.title("Monthly Traffic Flow Across the Year for " + country);
    chart.container("container");
    chart.draw();
};
