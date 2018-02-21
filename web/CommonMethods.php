<?php 
/*****************************************
** File:    CommonMethods.php
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    02/21/18
** Section: 504
** E-mail:  dominick@tamu.edu 
**
**   This file contains functions used by any and all PHP files
** that need to connect to the phpMyAdmin database for the 315 project 1.
**
***********************************************/

class Common
{	
	var $conn;
	var $debug;
	
	var $db="database.cse.tamu.edu";
	var $dbname="domfabian1";
	var $user="domfabian1";
	var $pass="\$\$\$pass\$\$\$word\$\$\$";
			
	function Common($debug)
	{
		$this->debug = $debug; 
		$rs = $this->connect($this->user); // db name really here
		return $rs;
	}

	// connect to MySQL DB Server
	function connect($db) {
		try {
			$this->conn = new PDO('mysql:host='.$this->db.';dbname='.$this->dbname, $this->user, $this->pass);
        }
        catch (PDOException $e) {
        	    print "Error!: $e->getMessage() <br/>";
	            die();
        	}
	}

    // execute query
	function executeQuery($sql, $filename) {
		if ($this->debug) {
            echo("$sql <br/>\n");
        }
        $rs = $this->conn->query($sql);
		return $rs;
	}			

}
?>
