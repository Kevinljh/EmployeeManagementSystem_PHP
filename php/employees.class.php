<?php

//
// Requires
// --------
// Make sure working directory is root so paths point properly.
// Since php files should be placed in either root or root/php, 
// this checks if working directory is /php and if so moves up
//
if(basename(getcwd()) == "php") chdir("../");
require_once("php/fullTimeEmployee.class.php");
require_once("php/partTimeEmployee.class.php");
require_once("php/seasonalEmployee.class.php");
require_once("php/contractEmployee.class.php");
require_once("php/users.class.php");

//
// Utilities
//
require_once("php/connect.php");
require_once("php/postcall.php");

/*
 * NAME 	: Employees
 *
 * PURPOSE 	: 
 *
 */
class Employees{
	private $db;
	private $users;
	
	function __construct(){
		$this->users = new Users();
		$this->db = connect();
	}
	
	function CheckFullTimeInfoErrors($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$salary){
		$employee = new FullTimeEmployee();
		$employee->SetFirstName($firstName);
		$employee->SetLastName($lastName);
		$employee->SetDateOfBirth($dateOfBirth);
		$employee->SetSIN($sin);
		$employee->SetDateOfHire($dateOfHire);
		$employee->SetDateOfTermination($dateOfTermination);
		$employee->SetSalary($salary);
		return $employee->GetErrors();
	}
	
	function CheckPartTimeInfoErrors($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$hourlyRate){
		$employee = new PartTimeEmployee();
		$employee->SetFirstName($firstName);
		$employee->SetLastName($lastName);
		$employee->SetDateOfBirth($dateOfBirth);
		$employee->SetSIN($sin);
		$employee->SetDateOfHire($dateOfHire);
		$employee->SetDateOfTermination($dateOfTermination);
		$employee->SetHourlyRate($hourlyRate);
		return $employee->GetErrors();
	}
	
	function CheckSeasonalInfoErrors($firstName,$lastName,$dateOfBirth,$sin,$season,$seasonYear,$piecePay){
		$employee = new SeasonalEmployee();
		$employee->SetFirstName($firstName);
		$employee->SetLastName($lastName);
		$employee->SetDateOfBirth($dateOfBirth);
		$employee->SetSIN($sin);
		$employee->SetSeason($season);
		$employee->SetSeasonYear($seasonYear);
		$employee->SetPiecePay($piecePay);
		return $employee->GetErrors();
	}
	
	function CheckContractInfoErrors($dateOfIncorporation,$companyName,$businessNumber,$startDate,$endDate,$fixedAmount){
		$employee = new ContractEmployee();
		$employee->SetDateOfIncorporation($dateOfIncorporation);
		$employee->SetCompanyName($companyName);
		$employee->SetBusinessNumber($businessNumber);
		$employee->SetStartDate($startDate);
		$employee->SetEndDate($endDate);
		$employee->SetFixedAmount($fixedAmount);
		return $employee->GetErrors();
	}
	
	function AddFullTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$salary){
		$employee = new FullTimeEmployee();
		$employee->SetFirstName($firstName);
		$employee->SetLastName($lastName);
		$employee->SetDateOfBirth($dateOfBirth);
		$employee->SetSIN($sin);
		$employee->SetDateOfHire($dateOfHire);
		$employee->SetDateOfTermination($dateOfTermination);
		$employee->SetSalary($salary);
		if($employee->Validate()){
			return true;
		}else{
			return false;
		}
	}
	
	function AddPartTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$hourlyRate){
		// todo
		return true;
	}
	
	function AddSeasonalEmployee($firstName,$lastName,$dateOfBirth,$sin,$season,$seasonYear,$piecePay){
		// todo
		return true;
	}
	
	function AddContractEmployee($dateOfIncorporation,$companyName,$businessNumber,$startDate,$endDate,$fixedAmount){
		// todo
		return true;
	}
	
	function SaveFullTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$salary){
		// todo
		return true;
	}
	
	function SavePartTimeEmployee($firstName,$lastName,$dateOfBirth,$sin,$dateOfHire,$dateOfTermination,$hourlyRate){
		// todo
		return true;
	}
	
	function SaveSeasonalEmployee($firstName,$lastName,$dateOfBirth,$sin,$season,$seasonYear,$piecePay){
		// todo
		return true;
	}
	
	function SaveContractEmployee($dateOfIncorporation,$companyName,$businessNumber,$startDate,$endDate,$fixedAmount){
		// todo
		return true;
	}
}



?>