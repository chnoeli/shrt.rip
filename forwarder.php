<?php
if (
    isset($_GET["protector"]) && !empty($_GET["protector"]) &&
    isset($_GET["shortUrl"]) && !empty($_GET["shortUrl"])
) {
}
var_dump($_GET);
include_once("init.php");
if ($_GET['protector'] == FORWARD_PROTECTOR) {
    $shorUrl = htmlspecialchars($_GET["shortUrl"]);
    $date = new DateTime();
    $currentTime = date_format($date, 'Y-m-d H:i:s');
    $longUrl = DB::queryFirstField("SELECT longUrl FROM `data` WHERE (expirationDate > %s OR expirationDate = 0) AND shortUrl = %s;", $currentTime, $shorUrl);
    if (!empty($longUrl)) {
        header('Location: ' . $longUrl);
        die;
    } else {
        header('Location: /' . SHORTURL_LOCATION . '/');
    }
}
