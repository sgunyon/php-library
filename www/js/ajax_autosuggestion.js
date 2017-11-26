/*
 * This script contains AJAX methods
 */

var xhr;
//run the init function when the page finishes loading.
window.onload = init;

function init() {
    //disable the autocomplete feature provided by the browser
    document.getElementById('request').setAttribute("autocomplete", "on");

    //put the focus into the text box
    //document.getElementById('request').focus();

    //create an XMLHttpRequest object by calling the createXmlHttpRequestObject function
    xhr = createXmlHttpRequestObject();
}

//create an XMLHttpRequest object
function createXmlHttpRequestObject()
{
    var xmlHttp;

    if (window.ActiveObject) {  //IE6 and older
        xmlHttp = new ActiveObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {  // IE7+, Chrome, Mozilla, Safari, Opera
        xmlHttp = new window.XMLHttpRequest();
    }
    else
        xmlHttp = false;

    return xmlHttp;
}

//set and send XMLHttp request
function processXMLHttpRequest() {
    var leftContent = document.getElementsByClassName('left_content')[0];
    // proceed only if the xmlHttp object isn't busy
    if (xhr.readyState === 4 || xhr.readyState === 0) {

        // retrieve the name typed by the user on the form
        var request = document.getElementById("request").value;

        xhr.open("POST", suggest_url + request, true);

        // specify the function to handle server responses
        xhr.onreadystatechange = handleServerResponse;

        // make the request
        xhr.send(null);
    }
    else {
        // if the connection is busy, try again after one second
        setTimeout("processXMLHttpRequest()", 1000);
    }
}

// executed automatically when a response is received from the server
function handleServerResponse()
{
    // move forward only if the transaction has completed
    if (xhr.readyState === 4) {
        // status of 200 indicates the transaction completed successfully
        if (xhr.status === 200) {
            // extract the XML received from the server
            xmlResponse = xhr.responseXML;

            if (xmlResponse) {
                displaySuggestions(xmlResponse.getElementsByTagName("books")[0]);
            }
            // a HTTP status different than 200 signals an error
            else {
                noResults();
            }
        }
    }
}

//populates the suggestion box with a table containing all the titles retrieved from a XML doc
function displaySuggestions(xmlDoc) {
    var leftContent = document.getElementsByClassName('left_content')[0];
    var rightContent = document.getElementsByClassName('right_content')[0];
    var books = xmlDoc.children;
    var ldivContent = "";
    var rdivContent = "";

    if (books.length > 1) {
        ldivContent += "<div class='title'>";
        ldivContent += "<span class='title_icon'>";
        ldivContent += "<img src='" + base_url + "/www/img/books/bullet1.gif' alt='' title='' /></span>Book List</div>";
        ldivContent += "<div class='new_products'>";

        //create a new row for each title
        for (i = 0; i < books.length; i++) {
            //retrive the title/image/id from the xml doc
            var idd = books.item(i).getElementsByTagName("id")[0].innerHTML;
            var title = books.item(i).getElementsByTagName("title")[0].innerHTML;
            var image = books.item(i).getElementsByTagName("image")[0].innerHTML;

            //build the html to display search results
            ldivContent += "<div class='new_prod_box'>";  //start a new row
            ldivContent += "<div class='new_prod_bg'>";
            ldivContent += "<a href='" + base_url + "/book/detail/" + idd + "'><img src='" + base_url + "/www/img/books/" + image + "' + alt='' title='' class='thumb' border='0' width='60' height='100' /></a></div>";
            ldivContent += "<br /><a href='" + base_url + "/book/detail/" + idd + "'>" + title + "</a><br />";
            ldivContent += "</div>";
        }

        ldivContent += "</div>";
        ldivContent += "<div class='clear'></div>";
        ldivContent += "</div>";  //finish
        //
        leftContent.innerHTML = ldivContent;
        rightContent.innerHTML = "<br/><br/><br/><b>Click a cover to view details or continue narrowing your search";

    } else if (books.length === 1) {

        for (i = 0; i < books.length; i++) {
            //retrive the title/image/id from the xml doc
            var idd = books.item(i).getElementsByTagName("id")[0].innerHTML;
            var title = books.item(i).getElementsByTagName("title")[0].innerHTML;
            var image = books.item(i).getElementsByTagName("image")[0].innerHTML;
            var description = books.item(i).getElementsByTagName("description")[0].innerHTML;
            var isbn = books.item(i).getElementsByTagName("isbn")[0].innerHTML;
            var publisher = books.item(i).getElementsByTagName("publisher")[0].innerHTML;
            var on_hand = books.item(i).getElementsByTagName("on_hand")[0].innerHTML;

            ldivContent += "<div class='title'><span class='title_icon'>";
            ldivContent += "<img src='" + base_url + "/www/img/books/bullet1.gif' alt='' title='' />";
            ldivContent += "</span>" + title + "</div><div class='feat_prod_box_details'>";
            ldivContent += "<div class='prod_img'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
            ldivContent += "<a href='" + base_url + "/book/detail/" + idd + "'><img src='" + base_url + "/www/img/books/" + image;
            ldivContent += "' alt='' title='' class='thumb' border='0' width='250' height='375' /></a>";
            ldivContent += "<br /><br /></div></div><div class='clear'></div></div>";

            rdivContent += "<br /><br /><br /><div class='prod_det_box'>";
            rdivContent += "<div class='box_top'></div><div class='box_center'>";
            rdivContent += "<div class='prod_title'>Description:<br /><br />";
            rdivContent += "</div><p class='details'>" + description;
            rdivContent += "<br /><br />Publisher: &nbsp&nbsp&nbsp&nbsp&nbsp" + publisher + "<br/>";
            rdivContent += "ISBN: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + isbn + "<br/>";
            rdivContent += "In Stock: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + on_hand + "</p>";
            rdivContent += "<div class='clear'></div><div class='box_bottom'></div></div></div></div>";

            rightContent.innerHTML = rdivContent;
            leftContent.innerHTML = ldivContent;
        }
    }

}

function noResults() {
    var leftContent = document.getElementsByClassName('left_content')[0];
    var rightContent = document.getElementsByClassName('right_content')[0];
    var ldivContent = "";
    var rdivContent = "";

    ldivContent += "<div class='title'><span class='title_icon'>";
    ldivContent += "<img src='" + base_url + "/www/img/books/bullet1.gif' alt='' title='' />";
    ldivContent += "No Results <br /><br /><br /><br /><br /><br /><br /><br />";


    rightContent.innerHTML = rdivContent;
    leftContent.innerHTML = ldivContent;
}


function updateSearch(e) {
    // get the event for different browsers
    e = (!e) ? window.event : e;
    processXMLHttpRequest();
}

/*
 function clickSearch(ev) {
 ev = (!ev) ? window.event : ev;
 if (ev.keyCode == 20) {     //right click exception
 
 } else {
 leftContent.innerHTML = "";
 }
 }
 */