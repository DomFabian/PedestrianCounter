<?php
/*****************************************
** File:    graphs.php
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    03/20/18
** Section: 504
** E-mail:  dominick@tamu.edu 
**
**   This file contains the page that will display charts
** about the foot traffic seen by the Arduino. It will have
** constructors for a number of charts and then will render
** each chart using the Fusion Charts JavaScript module.
** fusioncharts.php and fusioncharts.js are used under
** non-commercial license from Fusion Charts Technologies:
** https://github.com/fusioncharts.
**
***********************************************/

    include('graphFunctions.php');

    // include the FusionCharts PHP wrapper
    include('fusioncharts/fusioncharts.php');

    $table = '`ArduinoTest`';
    $a = getAllDatabaseEntries($table);
?>

<html>
    <head>
        <title>Foot Traffic</title>

        <!-- use the FusionCharts JS Library -->
        <script src="fusioncharts/fusioncharts.js"></script>
    </head>
    <body>
        <h1>Foot Traffic Statistics</h1>
        <h2>Summary</h2>
        Average number of students per hour: TODO<br>
        Average number of students per day: TODO<br>
        Average number of students per week: TODO<br>
        Average number of students per month: TODO<br>
        Average number of students per year: TODO<br>



        <?php
        /**
          *  Syntax for the constructor: `FusionCharts("type of * chart", "unique chart id", "width of chart", 
          *  "height of chart", "div id to render the chart", "data format", "data source")`
        */
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
            $columnChart->render();
        ?>
        <div id="chart-1"><!-- Fusion Charts will render here--></div>
    </body>
</html>
