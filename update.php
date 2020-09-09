<?php    
        include_once("config.php");
        require_once("db.php");

        DB::$host = DB_HOST;
        DB::$user = DB_USER;
        DB::$password = DB_PASSWORD;
        DB::$dbName = DB_NAME;

        $date = new DateTime(null, new DateTimeZone('UTC'));
        $currentTime = date_format($date, 'Y-m-d H:i:s');        
        $results = DB::query("SELECT * FROM `data` WHERE expirationDate > %s OR expirationDate = 0;", $currentTime);        
        $content = "### Created on ". $currentTime."\n";


        foreach ($results as $row) {
            $content .= "RedirectMatch 301 (.*)/".SHORTURL_PATH."/".$row['shortUrl']."$ ".$row['longUrl']." \n";
          }
          copy(SHORTURL_PATH."/.htaccess", SHORTURL_PATH."/.htaccess_back");
          file_put_contents(SHORTURL_PATH."/.htaccess", $content);
?>