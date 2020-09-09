<?php

    if (isset($_POST["longUrl"]) && !empty($_POST["longUrl"])) {   
             
        $longUrl = htmlspecialchars($_POST["longUrl"]);                
        $longUrl = filter_var($longUrl, FILTER_SANITIZE_URL);
        if (filter_var($longUrl, FILTER_VALIDATE_URL)) {
            include_once("config.php");
            require_once("db.php");
            DB::$host = DB_HOST;
            DB::$user = DB_USER;
            DB::$password = DB_PASSWORD;
            DB::$dbName = DB_NAME;

            
            do{
                $shortUrl = random_str(SHORTURL_LENGTH);   
            }while(DB::queryFirstField("SELECT shortUrl FROM `data` WHERE shortUrl=%s", $shortUrl) != NULL);
                                 
            
            //TODO Add Timezone according to user
            $date = new DateTime();

            $date->setTimezone(new DateTimeZone('UTC'));
            
            $creationDate = date_format($date, 'Y-m-d H:i:s');
            if (SHORTURL_EXPIRE > 0) {
                $date->add(new DateInterval('P'.SHORTURL_EXPIRE."D"));
                $expirationDate = date_format($date, 'Y-m-d H:i:s');
            }
            else {
                $expirationDate = 0;
            }
           
            DB::insert('data', [
                'longUrl' => $longUrl,
                'shortUrl' => $shortUrl,
                'creationDate' => $creationDate,
                'expirationDate' => $expirationDate
            ]); 
            if (empty(SHORTURL_LOCATION)) {                
                $fullShortUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']. "/".SHORTURL_PATH."/".$shortUrl;
            }
            else {
                $fullShortUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/" . SHORTURL_LOCATION . "/".SHORTURL_PATH."/".$shortUrl;
            }
            echo '{ "data": { "shortUrl":"' . $fullShortUrl . '", "expirationDate": "' . $expirationDate . '"} }'; 

        }
        else {
            echo '{ "error": { "code": "300", "value": "invalid url"} }';
        }

        include_once('update.php');            
    }
    elseif (empty($_POST["longUrl"])) {
        echo '{ "error": { "code": "300", "value": "invalid url"} }';
    }

    /**
 * Generate a random string, using a cryptographically secure 
 * pseudorandom number generator (random_int)
 *
 * This function uses type hints now (PHP 7+ only), but it was originally
 * written for PHP 5 as well.
 * 
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 * 
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
?>