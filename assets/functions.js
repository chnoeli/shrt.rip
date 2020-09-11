function createUrl() {
    var elem = document.getElementById("longUrlInput");    
    var longUrl = elem.value;    
    if(longUrl != "")
    {
        if (!longUrl.startsWith("http://")&&!longUrl.startsWith("https://")) {
		console.log("logurl")
            longUrl = "http://" + longUrl
            elem.value = longUrl;
        }
    }        
        invokeAjax("longUrl=" + longUrl, onLoadCreateUrl);
}

function onLoadCreateUrl(xhr) {        
    console.log(xhr.responseText);
    var result = JSON.parse(xhr.responseText);        
    
    var elemUrl = document.getElementById("shortUrl")
    var elemCpyBtn = document.getElementById("copyLink")
    if(!result.error){
        elemUrl.innerHTML = result.data.shortUrl
        elemUrl.href = result.data.shortUrl
        elemCpyBtn.classList.remove("hidden")
    }
    else{
        elemUrl.innerHTML = result.error.value
        elemCpyBtn.classList.add("hidden")
    }
    
    
}

document.addEventListener("DOMContentLoaded", function(){        
    document.getElementById("longUrlInput")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    console.log("hejjd");        
    if (event.keyCode === 13) {
        document.getElementById("submitLongUrl").click();
    }
}); 
    document.getElementById("submitLongUrl")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    console.log("hejjd");        
    if (event.keyCode === 13) {
        document.getElementById("submitLongUrl").click();
    }
});
    new ClipboardJS('#copyLink');


});




//Ajax Function
function invokeAjax(parameter, onLoadFunc = null) {
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'create.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    console.log(parameter);
    
    if (onLoadFunc !== null) {        
        xhr.onload = function() {
            if (xhr.status === 200) {                
                onLoadFunc(this)                
            }
            else if (xhr.status !== 200) {
                
            }                                    
        };
    }
    else{
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log("output" + xhr.responseText)                
            }
            else if (xhr.status !== 200) {
                
            }
        };
    }   
    
    xhr.send(encodeURI(parameter));
}
