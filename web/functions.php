<?php
/*****************************************
** File:    functions.php
** Project: CSCE 315 Project 1, Spring 2018
** Date:    02/21/18
** Section: 504
**
**   This file contains functions used by the index page of
** the site.
**
***********************************************/    

    include('Common.php');

    $debug = false;
    $COMMON = new Common($debug);
    
    $secretKey = "ourSecretArduinoKey";

    function insertIntoDatabase($table) {
        /* This function takes one parameter and returns an error code.
           Parameter is the name of the database table.
           Error code 0: could not insert into database.
           Error code 1: successful insert into database. */

        global $COMMON;
        
        $sql = "INSERT INTO $table (`time`) VALUES (CURRENT_TIMESTAMP);";
        $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
        if (empty($rs)) {
            return 0;
        }
        else {
            $row = $rs->fetch(PDO::FETCH_ASSOC);
            return 1;
        }    
    }

    function getNumDatabaseEntries($table) {
        /* This function takes one parameter and returns the number
           of entries in the database. This number signifies the total
           number of people who have been detected by the Arduino
           since the database table was created.
           Parameter is the name of the database table.
           Return value will be a positive integer.
         */

        global $COMMON;

        $sql = "SELECT COUNT(*) FROM $table;";
        $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
        $row = $rs->fetch(PDO::FETCH_ASSOC);
        return $row['COUNT(*)'];
    }

    function sanitize($str) {
        /* This function takes one parameter and returns a "sanitized"
           version of that parameter.
           Parameter is a string that contains any kind of characters.
           The characters can be numbers, letters, special characters,
           etc.
           Return value will be another string with each of the non-
           alphanumeric characters removed. */

        // allow only characters A-Z, a-z, or 0-9
        $regex = "/[^A-Za-z0-9 ]/";

        return preg_replace($regex, '', $str);
    }

    function handleArduinoPing($key) {
        /* This function takes one parameter and returns an
           integer error code. handleArduinoPing() is the script
           run by the webserver whenever the Arduino of the
           PedestrianCounter detects that somebody has walked by
           and sends a message to the webserver. This function
           will be called whenever a POST request is made to the
           webserver. The function ensures that a specific $key is
           provided in the body of the HTTP POST request before
           sending any information to the database.
           Parameter is a string key from the Arduino.
           Error code 0: unable to handle Arduino ping (DB error).
           Error code -1: invalid key provided by Arduino.
           Error code 1: successful handle of Arduino ping. */
        
        global $COMMON;
        global $secretKey;
        global $tableName;

        // always sanitize anything provided to the server
        $safeKey = sanitize($key);

        // check for invalid Arduino key or non-string input
        if ($safeKey != $secretKey) {
            return -1;
        }
        else {
            $statusCode = insertIntoDatabase($tableName);
            return $statusCode;
        }
    }

    // this file is included in other files, so only have an error
    // message when this specific page is accessed.
    if ($_SERVER['REQUEST_URI'] == "/domfabian1/functions.php") {
?>

<h1>
    Whoops!
</h1>
There is nothing to see here. Try going back to the
    <a href="http://projects.cse.tamu.edu/domfabian1/">index page</a>
    .

<?php
    }
?>
