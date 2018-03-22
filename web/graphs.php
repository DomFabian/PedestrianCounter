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
?>

<html>
    <head>
        <title>Foot Traffic</title>

        <!-- use the FusionCharts JS Library -->
        <script src="fusioncharts/fusioncharts.js"></script>
    </head>
    <body>
        <?php
            if (isset($_POST['start']))
                displayData($_POST);
            else
                collectData($_GET);
        ?>

    </body>
</html>

