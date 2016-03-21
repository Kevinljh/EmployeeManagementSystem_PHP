<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");
require_once("php/hourlyEmployee.class.php");


class FullTimeEmployee extends HourlyEmployee{
	private $salary;
	
	public function SetSalary($salary){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		if($this->ValidNumber($salary)){
			$this->salary = $salary;
			return true;
		}else{
			$this->errors["salary"] = "Salary can't be negative";
			return false;
		}
	}
	
	// maybe move this to employee.class.php
	private function ValidNumber($number){
		return $number >= 0;
	}
}

?>