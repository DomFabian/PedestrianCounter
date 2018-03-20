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

    $debug = true;
    $COMMON = new Common($debug);

    function getAllDatabaseEntries($table) {
        /* This function takes one parameter and returns
           an array of all of the entries in the database.
           In the event of an error, an empty array is returned.
           Note that the returned array is a two-dimensional
           array that has the entry ID as the first index and
           the datetime as the second index. For example,
           array[0]['time'] would give the timestamp of the 
           first entry in the database table.
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

            // loop through results and store in the array
            while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
                $array[] = $row;
            }
        }

        return $array;
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