<?php
/*****************************************
** File:    testCases.php
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    02/21/18
** Section: 504
** E-mail:  dominick@tamu.edu 
**
**   This file contains functions that test each of the functions
** that will be implemented for the server-side logic. The functions
** under test can be found in functions.php.
**
***********************************************/    

    include('functions.php');

    $tableName = '`ArduinoTest`';

    function test_insertIntoDatabase() {
        /* This function calls the insertIntoDatabase() function and
           checks that it actually creates a new row in the database.
           Both a valid $table name and an invalid $table name are
           supplied, which tests the function's ability to return each
           of its possible error codes. */
        
        global $tableName;

        // get the number of entries before test
        $before = getNumDatabaseEntries($tableName);

        // should return 1 (for success)
        $test1 = insertIntoDatabase($tableName);

        // should return 0 (for failure)
        $test2 = insertIntoDatabase('`InvalidName`');

        // get the number of entries after test (should be $before + 1)
        $after = getNumDatabaseEntries($tableName);

        $passCond = (($test1 + $test2) == 1) && ($after == $before + 1);
        echo("test_insertIntoDatabase: ");
        echo $passCond ? "pass" : "fail";
        echo "<br>";
    }

    function test_getNumDatabaseEntries() {
        /* This function calls the getNumDatabaseEntries() function and
           checks that it returns an updated number of entries in the
           database each time a new entry is made. */

        global $tableName;

        // get the number of entries before test
        $before = getNumDatabaseEntries($tableName);
        $passCond = true;

        // test the function 9 times
        for ($i = 1; $i < 10; $i++) {
            insertIntoDatabase($tableName);
            $newNum = getNumDatabaseEntries($tableName);
            $passCond = $passCond && ($newNum == $before + $i);
        }
        echo("test_getNumDatabaseEntries: ");
        echo $passCond ? "pass" : "fail";
        echo "<br>";
    }

    function testAll() {
        /* This function runs all the above tests. */
        
        test_insertIntoDatabase();
        test_getNumDatabaseEntries();
    }

    testAll();
?>
