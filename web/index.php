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
** This file relies on the fact that the Arduino can send a 
** specially-crafted HTTP POST request to the server that
** no on else will know how to create.
**
***********************************************/

    include('functions.php');

    $tableName = '`ArduinoTest`';

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // if just visiting site, not sending data to it
        
        // TODO: define action; probs just some HTML filler
    }
    else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // if attempting to send data to server

        // TODO: perform test to see how a POST request should
        //       be formatted as if the server had sent a form
        //       to request the key from the Arudino client!
        //          Maybe use BurpSuite proxy?

        $receivedKey = $_POST["key"];
        $statusCode = handleArduinoPing($receivedKey);
    }
?>
