<?php
//Check if config.php exists
if (!file_exists("config.php")) {
    echo "config.php not found.";
    exit;
}
include_once("config.php");

if (!file_exists("db.php")) {
    echo "db.php not found.";
    exit;
}
require_once("db.php");

//Check if database exists
DB::$host = DB_HOST;
DB::$user = DB_USER;
DB::$password = DB_PASSWORD;
DB::$dbName = DB_NAME;
DB::$error_handler = 'errorHandler'; // runs on mysql query errors
DB::$nonsql_error_handler = 'errorHandler'; // runs on library errors (bad syntax, etc)

//Test Database
DB::query("SELECT * FROM data;");


//Check if .htaccesfile exist 
if (!file_exists(SHORTURL_PATH."/.htaccess")) {
    if (!file_exists(SHORTURL_PATH)) {
        mkdir(SHORTURL_PATH);
    }
    $content = "RewriteEngine On\nRewriteRule (.*) ".SHORTURL_LOCATION."forwarder.php?protector=".FORWARD_PROTECTOR."&shortUrl=$1";
    file_put_contents(SHORTURL_PATH."/.htaccess", $content);
}

//Check if Random string has been set otherwise print random string
if (FORWARD_PROTECTOR == "") {
    echo "FORWARD_PROTECTOR has not been set or is empty. Try: <br>" ;
    echo 'define("FORWARD_PROTECTOR", "'.random_str(8).'")';
    exit();
}

//DB Error Handler
function errorHandler($params)
{
    $errorType = $params['type'];
    $errorStr = $params['error'];
    $errorQuerry = $params['error'];

    if ($errorType == "sql") {
        $errorcode = $params['code'];
        switch ($errorcode) {
                //Table not found
            case '1146':
                createTable();
                echo "Table created reload the page to start.";
                break;

            default:
                echo "There has been a SQL error please.";
                break;
        }
    } elseif ($errorType == "nonsql") {
        echo $errorStr;
    }
    die; // don't want to keep going if a query broke
}

function createTable()
{
    //Create table
    $createTableQuery = "CREATE TABLE IF NOT EXISTS `data` (
            `id_data` int(11) NOT NULL AUTO_INCREMENT,
            `longUrl` varchar(2000) NOT NULL,
            `shortUrl` varchar(2000) NOT NULL,
            `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            `expirationDate` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id_data`)
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;";
    DB::query($createTableQuery);
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