function createUrl() {
    var elem = document.getElementById("longUrlInput");    
    var longUrl = elem.value;    
    //TODO Validate Url
    invokeAjax("longUrl=" + longUrl, onLoadCreateUrl);
}

function onLoadCreateUrl(xhr) {        
    console.log(xhr.responseText);
    var result = JSON.parse(xhr.responseText);        
    
    var elemUrl = document.getElementById("shortUrl")
    var elemExpiration = document.getElementById("expirationDate")
    if(!result.error){
        elemUrl.innerHTML = result.data.shortUrl
        elemUrl.href = result.data.shortUrl
        elemExpiration.innerHTML = result.data.expirationDate
    }
    else{
        elemUrl.innerHTML = result.error.value
    }
    
    
}


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