<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/mini-default.min.css">
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/functions.js"></script>
    <script src="assets/clipboard.min.js"></script>
    <title>Urlshortener</title>
</head>
<body>
<div class="container wrapper">
    <div class="row">
        <h1 class="col-sm">URL Shortener <small>Tool for shortening URLs</small></h1>
    </div>

    <div class="row">
        <input autocomplete="off" type="text" name="longUrl" class="col-sm" id="longUrlInput" tabindex="1">
        <a class="button" onclick="createUrl()" id="submitLongUrl" tabindex="2">Submit</a>
                
    </div>
    <div class="row">  
        <div class="col-sm" id="resultContainer">
            <a id="shortUrl" target="_blank" tabindex="4"></a>
            <button class="small hidden" id="copyLink" data-clipboard-target="#shortUrl" tabindex="3">Copy</button>            
        </div>
    </div>
    <footer>
        <p>© 2020 <span id="copyrightYear"></span> <a href="https://noel-stammbach.ch" class="footerLink">Noel Stammbach</a> | <label for="modal-about">About</label> | <label for="modal-disclaimer">Disclaimer</label></p>
    </footer>
    
    <input type="checkbox" id="modal-about" class="modal">
    <div>
        <div class="card">
            <label for="modal-about" class="modal-close" ></label>
            <h3 class="section">About</h3>
            <p class="section">This is a small URL shortener that I created from scratch as a fun project. </br> <strong>Imprint:</strong> </br> Noel Stammbach </br> admin@shrt.rip</p>        
        </div>
    </div>    

    <input type="checkbox" id="modal-disclaimer" class="modal">
    <div>
        <div class="card">
            <label for="modal-disclaimer" class="modal-close" ></label>
            <h3 class="section">Disclaimer</h3>
            <p class="section">The usage of this URL Shortener is only allowed for purposes that are permitted by any applicable law. Activities on this URL shortener are logged and may be used for investigative purpose in compliance with applicable laws. I take no responsibility for any content exchanged over shrt.rip shortened URLs nor for the consequences of any content exchange.</p>        
        </div>
    </div>    
    <script>        
        currentYear = new Date().getFullYear();
        if(currentYear != "2021")
        {
            document.getElementById("copyrightYear").innerHTML = " - "+currentYear;
        }
    </script>
</div>
    
    
</body>
</html>