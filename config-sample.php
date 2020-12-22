<?php
    //Length of generated shorturl
    define("SHORTURL_LENGTH", 8);
    //Path to the .htaccess file 
    define("SHORTURL_PATH", "s");
    //Location if URL shortener is not on root domain
    define("SHORTURL_LOCATION", "urlshortener");
    //Number of days URL will expire
    define("SHORTURL_EXPIRE", 3);
    //Database Host
    define("DB_HOST", "127.0.0.1");
    //Database Name
    define("DB_NAME", "urlshortener");
    //Database User
    define("DB_USER", "root");
    //Database Password
    define("DB_PASSWORD", "");
    //Random keyspace
    define("KEYSPACE", "0123456789abcdefghiklmnopqrstuvwxyz");
    //Random passphrase to have a little more control on the forwarding.php file. Just take any random String.
    define("FORWARD_PROTECTOR", "")

?>