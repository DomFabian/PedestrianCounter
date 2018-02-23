<?php
/*****************************************
** File:    functions.php
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    02/21/18
** Section: 504
** E-mail:  dominick@tamu.edu 
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

        // TODO: implement me!

        return "abc";
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
           Parameter is a string key.
           Error code 0: unable to handle Arduino ping (DB error).
           Error code -1: invalid key provided by Arduino.
           Error code 1: successful handle of Arduino ping. */

        // TODO: implement me!
        
        global $COMMON;
        global $secretKey;

        return ($key == $secretKey) ? 1 : -1;
    }

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
