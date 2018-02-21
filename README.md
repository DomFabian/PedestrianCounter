# PedestrianCounter

## Using the Web Resources
The PedestrianCounter system currently uses a MySQL database backend with server-side PHP scripts to interface with the database. Because PedestrianCounter uses the PHP Object-Oriented DB connection style, the underlying database backend can be changed all in one place: `filename.php`.

Prerequisites for using PedestrianCounter:
* Webserver that supports PHP 5 (`5.4.16` currently used)
* Database with MySQL database client version: `libmysql - mysqlnd 5.0.10`
* PHPMyAdmin (`4.4.15.10` currently used)

Again, the flexible nature of the PHP Object-Oriented DB connection style makes changing databases relatively easy.