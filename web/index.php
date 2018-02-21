<?php
/*****************************************
** File:    index.php
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    02/21/18
** Section: 504
** E-mail:  dominick@tamu.edu 
**
**   This file contains the index landing page for the
** 315 project 1. All GET and POST requests coming from
** the PedestrianCounter will be handled by this script.
**
***********************************************/    

    include('CommonMethods.php');
    $debug = true;
    $COMMON = new Common($debug);
    $tableName = '`ArduinoTest`';

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

    $test = insertIntoDatabase($tableName);
    var_dump($test);
    echo "<br><br>";
    //echo getNumDatabaseEntries($tableName);

?>