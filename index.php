<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/mini-default.min.css">
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/functions.js"></script>
    <title>Urlshortener</title>
</head>
<body>
<div class="container wrapper">
    <div class="row">
        <h1 class="col-sm">URL Shortener <small>This is a small tool for URL shortening</small></h1>
    </div>

    <div class="row">
        <input autocomplete="off" type="text" name="longUrl" class="col-sm" id="longUrlInput">
        <a class="button col-sm-2" onclick="createUrl()">Submit</a>
                
    </div>
    <div class="row">  
        <div class="col-sm">
            <a href="" id="shortUrl" target="_blank"></a>
            <p class="hidden" id="expirationDate"></p>
        </div>      
        
    </div>
</div>
    
</body>
</html>