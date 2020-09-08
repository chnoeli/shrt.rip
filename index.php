<?php
    if (isset($_POST["longUrl"]) && !empty($_POST["longUrl"])) {
        include_once("config.php");
        //TODO insert correct URL check
        $longUrl = htmlspecialchars($_POST["longUrl"]);

        $shortUrl = random_str(SHORTURL_LENGTH);
        //Check if ShortURL already has been used
        
        //TODO Add Timezone according to user
        $date = new DateTime();

        $date->setTimezone(new DateTimeZone('UTC'));
        
        $creationDate = $date->getTimestamp();
        if (SHORTURL_EXPIRE > 0) {
            $date->add(new DateInterval('P'.SHORTURL_EXPIRE."D"));
            $expirationDate = $date->getTimestamp();
        }
        else {
            $expirationDate = 0;
        }
        echo $creationDate;
        echo "<br>";
        echo $expirationDate;
        echo "<br>";
        echo $longUrl;
        echo "<br>";
        echo $shortUrl;
        echo "<br>";

        require_once("db.php");
        DB::$host = DB_HOST;
        DB::$user = DB_USER;
        DB::$password = DB_PASSWORD;
        DB::$dbName = DB_NAME;
        
        DB::insert('data', [
            'longUrl' => $longUrl,
            'shortUrl' => $shortUrl,
            'creationDate' => $creationDate,
            'expirationDate' => $expirationDate
          ]);
        





        
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Urlshortener</title>
</head>
<body>
    Hello, This is a small to for URL shortening.

    <form action="" method="post">
        <input type="text" name="longUrl" id="longUrlInput">
        <input type="submit" value="Submit">
    </form>
</body>
</html>