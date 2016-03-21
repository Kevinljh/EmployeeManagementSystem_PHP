<?php

class ContractEmployee{
	private $dateOfIncorporation;
	private $companyName;
	private $businessNumber;
	private $startDate;
	private $endDate;
	private $fixedAmount;
	private $errors = array();
	
	public function SetDateOfIncorporation($dateOfIncorporation){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->dateOfIncorporation = $dateOfIncorporation;
		return true;
	}
	
	public function SetCompanyName($companyName){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->companyName = $companyName;
		return true;
	}
	
	public function SetBusinessNumber($businessNumber){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->businessNumber = $businessNumber;
		return true;		
	}
	
	public function SetStartDate($startDate){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->startDate = $startDate;
		return true;		
	}
	
	public function SetEndDate($endDate){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->endDate = $endDate;
		return true;		
	}
	
	public function SetFixedAmount($fixedAmount){
		// todo: validation logic
		// don't set class variable if invalid
		// return false if invalid
		$this->fixedAmount = $fixedAmount;
		return true;		
	}
	
	public function GetErrors(){
		return $this->errors;
	}
}

?>