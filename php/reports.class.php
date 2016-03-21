<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");

//
// Utilities
//
require_once("php/connect.php");
require_once("php/postcall.php");

/*
 * NAME 	: Reports
 *
 * PURPOSE 	: Reports class
 *
 */
class Reports{
	private $db;
	
	function __construct(){
		$this->db = connect();
	}
	
	
}



?>