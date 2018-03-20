<?php
/*****************************************
** File:    graphFunctions.php
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    03/20/18
** Section: 504
** E-mail:  dominick@tamu.edu 
**
**   This file contains the functions used by graphs.php.
** Each of the functions here have the goal of providing
** analysis of the entries in the database.
**
***********************************************/

    include('Common.php');

    $debug = false;
    $COMMON = new Common($debug);

    function getAllTimestamps($table) {
        /* This function takes one parameter and returns
           an array of all of the entries in the database.
           In the event of an error, an empty array is returned.
           Note that the returned array is an array of integers
           with each of the integers representing the UNIX time
           of the entry's timestamp.
           Pre-conditions: connection with database is already
                           established.
           Post-conditions: a database query to get all of the
                            entries in the table is made. */

        global $COMMON;

        $sql = "SELECT * FROM $table;";

        $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);

        if(empty($rs)) {
            // if there was no response, return an empty array
            $array = [];
        }
        else {
            $array = array();

            // loop through results and store each entry in the array
            // each entry in array is an
            while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
                array_push($array, strtotime($row['time']));
            }
        }

        return $array;
    }

    function countEntriesBetweenTimes($array, $startTime, $endTime) {
        /* This function returns the number of times in an array
           that fall between a start time and an end time. This
           function requires that all times be in UNIX time.
           Pre-conditions: the input array has all of the times in
                           UNIX time format as an integer.
           Post-conditions: none. */

        $count = 0;

        // if start time is after end time, there are none
        if($startTime > $endTime) {
            return $count;
        }

        foreach($array as $time) {
            if ($time >= $startTime && $time <= $endTime) {
                $count++;
            }
        }

        return $count;
    }


    // this file is included in other files, so only have an error
    // message when this specific page is accessed.
    if ($_SERVER['REQUEST_URI'] == "/domfabian1/graphFunctions.php") {
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
