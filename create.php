<?php

if (isset($_POST["longUrl"]) && !empty($_POST["longUrl"])) {
    include_once("init.php");

    $longUrl = htmlspecialchars($_POST["longUrl"]);
    $longUrl = filter_var($longUrl, FILTER_SANITIZE_URL);

    if (filter_var($longUrl, FILTER_VALIDATE_URL)) {

        do {
            $shortUrl = random_str(SHORTURL_LENGTH, KEYSPACE);
        } while (DB::queryFirstField("SELECT shortUrl FROM `data` WHERE shortUrl=%s", $shortUrl) != NULL);

        $date = new DateTime();
        $creationDate = date_format($date, 'Y-m-d H:i:s');
        if (SHORTURL_EXPIRE > 0) {
            $date->add(new DateInterval('P' . SHORTURL_EXPIRE . "D"));
            $expirationDate = date_format($date, 'Y-m-d H:i:s');
        } else {
            $expirationDate = 0;
        }

        DB::insert('data', [
            'longUrl' => $longUrl,
            'shortUrl' => $shortUrl,
            'creationDate' => $creationDate,
            'expirationDate' => $expirationDate
        ]);
        $fullShortUrl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . SHORTURL_LOCATION . SHORTURL_PATH . "/" . $shortUrl;
        echo '{ "data": { "shortUrl":"' . $fullShortUrl . '", "expirationDate": "' . $expirationDate . '"} }';

        DB::disconnect();
    } else {
        echo '{ "error": { "code": "300", "value": "invalid url"} }';
    }
} elseif (empty($_POST["longUrl"])) {
    echo '{ "error": { "code": "300", "value": "invalid url"} }';
} else {
    echo '{ "error": { "code": "310", "value": "general url"} }';
}
