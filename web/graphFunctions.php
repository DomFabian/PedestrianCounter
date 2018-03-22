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
    $hour = 60 * 60;
    $day = 24 * $hour;
    $week = 7 * $day;
    $month = 30 * $day;
    $year = 12 * $month;

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


    function collectData() {
        /* This function handles when a GET /graphs.php request is
           read by the webserver. It shows some quick summary statistics
           and then prompts the user to enter a custom date range to 
           get specific data about a range of dates.
           Pre-conditions: database already queried and all timestamp data
                           is available in an array.
           Post-conditions: an HTML form is displayed, allowing for the
                            sending of a POST /graphs.php request to me made. */

        echo "<h1>Foot Traffic Statistics</h1>";
        echo "<h2>Summary</h2>";

        // query database for all students to ever enter the Rec
        $table = '`ArduinoTest`';
        $array = getAllTimestamps($table);

        // use global time values (integers)
        global $hour;
        global $day;
        global $week;
        global $month;
        global $year;

        // timezones are really annoying, so set some constants
        $timezoneOffset = 5 * 60 * 60;
        $now = strtotime("now") - $timezoneOffset;
        $beginningOfTime = -999999999999;

        // calculate number of students per timeframe
        $count1 = countEntriesBetweenTimes($array, $now - $hour, $now);
        $count2 = countEntriesBetweenTimes($array, $now - $day, $now);
        $count3 = countEntriesBetweenTimes($array, $now - $week, $now);
        $count4 = countEntriesBetweenTimes($array, $now - $month, $now);
        $count5 = countEntriesBetweenTimes($array, $now - $year, $now);
        $count6 = countEntriesBetweenTimes($array, $beginningOfTime, $now);

        // display the above calculated data
        echo "Number of students in past hour: $count1<br>\n";
        echo "Number of students in past day: $count2<br>\n";
        echo "Number of students in past week: $count3<br>\n";
        echo "Number of students in past month: $count4<br>\n";
        echo "Number of students in past year: $count5<br>\n";
        echo "Number of students total: $count6<br>\n";

        echo "<br>\n";

        //Syntax for the constructor: `FusionCharts("type of * chart", "unique chart id", "width of chart", 
        //"height of chart", "div id to render the chart", "data format", "data source")`
        $columnChart = new FusionCharts("Column2D", "myFirstChart" , 600, 300, "chart-1", "json",
            '{
                "chart": {
                    "caption": "Monthly revenue for last year",
                    "subCaption": "Harry\'s SuperMart",
                    "xAxisName": "Month",
                    "yAxisName": "Revenues (In USD)",
                    "numberPrefix": "$",
                    "theme": "zune"
                },
                "data": [
                        {"label": "Jan", "value": "420000"}, 
                        {"label": "Feb", "value": "810000"},
                        {"label": "Mar", "value": "720000"},
                        {"label": "Apr", "value": "550000"},
                        {"label": "May", "value": "910000"},
                        {"label": "Jun", "value": "510000"},
                        {"label": "Jul", "value": "680000"},
                        {"label": "Aug", "value": "620000"},
                        {"label": "Sep", "value": "610000"},
                        {"label": "Oct", "value": "490000"},
                        {"label": "Nov", "value": "900000"},
                        {"label": "Dec", "value": "730000"}
                    ]
            }');

        // render the constructed chart as chart-1
        //$columnChart->render();
 
        ?>

        <!-- chart-1 will render here-->
        <div id="chart-1"></div>

        <br><br>

        <!-- Allow the use to enter a custom date range -->
        <form action="graphs.php" method="post">
                Enter custom date range: <br>
                From: <input type="date" name="start" value="2018-01-01">  
                to: <input type="date" name="end" value="<?php echo date('Y-m-d'); ?>"> <br>
                <input type="submit"> <br>
        </form>
    <?php
    }

    function displayData() {
        /* This function handles the POST /graphs.php request when
           seen by the webserver. It handles the submitted date range
           and calculates relevant statistical data about the range.
           This page uses JavaScript to display chart information.
           Pre-conditions: database already queried and all timestamp data
                           is available in an array.
           Post-conditions: user is prompted to send GET /graphs.php request. */

        global $hour;
        global $day;
        global $week;
        global $month;
        global $year;

        echo "Make a new request: ";
        echo "<form action='graphs.php' method='get'>";
        echo "<input type='submit' value='New request'>";
        echo "</form>";
    }
?>
