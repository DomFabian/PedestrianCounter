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
** under test can be found in functions.php. It also includes a
** simple HTML interface by which anyone can run an integration test
** on the functions and see the results. The testing page can be 
** found at: http://projects.cse.tamu.edu/domfabian1/testCases.php
**
***********************************************/    

    include('functions.php');
    include('graphFunctions.php');

    $tableName = '`ArduinoTest`';

    function makeTestButton() {
        /* This function generates some HTML for a testing button. */
        ?>
        <h1>Integration Test</h1>
        Press the below button to conduct an integration test: <br>
        <form action="testCases.php" method="post">
            <input type="submit" value="Test!">
        </form>
        <?php
    }

    function printTestResult($passCond) {
        /* This function prints the pass/fail status of a test. */

        echo $passCond ? "pass" : "fail";
        echo "<br>\n";
    }

    function test_insertIntoDatabase() {
        /* This function calls the insertIntoDatabase() function and
           checks that it actually creates a new row in the database.
           Both a valid $table name and an invalid $table name are
           supplied, which tests the function's ability to return each
           of its possible error codes.
           Pre-condition: connection to database established
           Post-condition: new entry made in database table */
        
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
        printTestResult($passCond);
    }

    function test_getNumDatabaseEntries() {
        /* This function calls the getNumDatabaseEntries() function and
           checks that it returns an updated number of entries in the
           database each time a new entry is made.
           Pre-condition: connection to database established
           Post-condition: number of entries in table returned */

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
        printTestResult($passCond);
    }

    function test_sanitize() {
        /* This function calls the sanitize() function and checks
           that it returns a string that is actually sanitized. A
           sanitized string should have only alphanumeric 
           characters in it. Any characters that are not either
           numbers or letters A-Z and a-z should not appear in the
           returned string of sanitize().
           Pre-condition: arbitrary string provided
           Post-condition: sanitized string returned */

        $testStringArray = array("thisIsInvalidString1",
                                 "this_is_invalid_string",
                                 "this!is@also#an\$invalid^string",
                                 "<script>invalidString</script>");

        $passCond = true;

        foreach ($testStringArray as $str) {
            /* Using the ctype_alnum() function checks that each
               character in the returned string is an alphanumeric
               character. If sanitize() works correctly, ctype_alnum
               will return true and this will not change the $passCond
               variable. */
            $passCond = $passCond && ctype_alnum(sanitize($str));
        }
        
        echo("test_sanitize: ");
        printTestResult($passCond);
    }

    function test_handleArduinoPing() {
        /* This function calls the handleArduinoPing() handler
           function and ensures that it is able to make an entry
           in the database when a valid key is received. It will
           also ensure that proper error codes are returned in case
           of a failure.
           Pre-condition: connection to database established
           Post-condition: HTTP POST request handled by webserver,
                           new entry made in database table */

        global $secretKey;
        $passCond = true;
        
        // test ability to make database entry
        $ret = handleArduinoPing($secretKey);
        $passCond = $passCond && ($ret == 1);

        // test ability to identify bad key
        $badKey = "badKey";
        $ret = handleArduinoPing($badKey);
        $passCond = $passCond && ($ret == -1);

        echo("test_handleArduinoPing: ");
        printTestResult($passCond);
    }

    function test_getAllTimestamps() {
        /* This function calls the getAllTimestamps() function
           and ensures that it indeed returns an array of the same
           size as the number of entries in the database. It also
           ensures that if a connection to the database cannot be
           made, that an empty array is returned.
           Pre-condition: database is created and can be queried.
           Post-condistion: count of entries in the database will
                            be queried and array will be made. */

        global $tableName;
        $passCond = true;

        echo("test_getAllTimestamps: ");
        printTestResult($passCond);
    }

    function test_countEntriesBetweenTimes() {
        /* This function calls the countEntriesBetweenTimes()
           function and ensures that it is indeed able to count
           the number of elements in an array that are between the
           given range.
           Pre-conditions: none.
           Post-conditions: a few small arrays are created. */

        $passCond = true;

        $testArray1 = array(12, 13, 14, 100, 101, 102, 1000);
        $testArray2 = [];
        $testArray3 = array(100, 101, 102, 103, 104, 105);

        $test1 = (countEntriesBetweenTimes($testArray1, 10, 20) == 3);
        $test2 = (countEntriesBetweenTimes($testArray2, 0, 100) == 0);
        $test3 = (countEntriesBetweenTimes($testArray3, 100, 105) == 6);

        $passCond = $passCond && $test1 && $test2 && $test3;

        echo("test_countEntriesBetweenTimes: ");
        printTestResult($passCond);
    }

    function testAll() {
        /* This function runs all the above tests. */

        test_insertIntoDatabase();
        test_getNumDatabaseEntries();
        test_sanitize();
        test_handleArduinoPing();
        test_getAllTimestamps();
        test_countEntriesBetweenTimes();
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // if just visiting site, be able to conduct a test
        makeTestButton();
    }
    else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // if button pressed, conduct the test
        testAll();
    }
?>
