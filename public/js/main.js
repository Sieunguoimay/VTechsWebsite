// scroll functions
$(window).scroll(function(e) {

    // add/remove class to navbar when scrolling to hide/show
    var scroll = $(window).scrollTop();
    if (scroll >= 450) {
        $('.navbar').addClass("navbar-hide");
    } else {
        $('.navbar').removeClass("navbar-hide");
    }

});


function topFunction(){
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
// Add smooth scrolling to all links
$("#home_get_started_btn").on('click', function(event) {
    $('html,body').animate({
        easing:"swing",
        scrollTop: $("#home_products_section").offset().top,
        scrollSpeed:800},
        'fast');
  });


var removeByAttr = function(arr, attr, value){
    var i = arr.length;
    while(i--){
       if( arr[i] 
           && arr[i].hasOwnProperty(attr) 
           && (arguments.length > 2 && arr[i][attr] === value ) ){ 

           arr.splice(i,1);

       }
    }
    return arr;
}

function httpPostRequest(theUrl, dataToSend,callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("POST", theUrl, true); // true for asynchronous 
    xmlHttp.setRequestHeader("Content-Type","application/json;charset=UTF-8");

    xmlHttp.setRequestHeader("X-CSRF-TOKEN",document.querySelector('meta[name="csrf-token"]').content);
    xmlHttp.send(dataToSend);
}

function SendNewViewToServer(objectType,objectId=0){

    new Fingerprint2().get(function(result, components){
        removeByAttr(components,'key','webgl');
        removeByAttr(components,'key','canvas');
        console.log("fingerprintjs2 hash: %s", result);
        let data={
            object_type:objectType,
            object_id:objectId,
            metadata:components,
            fingerprint:result,
            url:window.location.href};
        httpPostRequest('/store_view',JSON.stringify(data),function(response){
            console.log(response);
        });    
    });
}

