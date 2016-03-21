<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");
require_once("php/employee.class.php");


class SeasonalEmployee extends Employee{
	private $piecePay;
	private $season;
	private $seasonYear;

	public function SetPiecePay($piecePay){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->piecePay = $piecePay;
		return true;
	}
		
	public function SetSeason($season){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->season = $season;
		return true;
	}
	
	public function SetSeasonYear($seasonYear){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->seasonYear = $seasonYear;
		return true;
	}
}

?>