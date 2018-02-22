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

    include('functions.php');

    $tableName = '`ArduinoTest`';

    $test = insertIntoDatabase($tableName);
    var_dump($test);
    echo "<br><br>";
    //echo getNumDatabaseEntries($tableName);
?>
