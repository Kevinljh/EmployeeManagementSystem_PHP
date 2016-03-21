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
 * NAME 	: User
 *
 * PURPOSE 	: The user class contains several functions used
 *			  to log in/authenticate
 */
class Users{
	private $db;
	
	function __construct(){
		$this->db = connect();
	}
	
	function userType(){
		if(isset($_SESSION["type"])){
			return $_SESSION["type"];
		}else{
			return "none";
		}
	}

	function login($username,$password){	
		$loginType = false;
		
		$query = $this->db->prepare("SELECT id,password,securityLevel FROM User WHERE username = ? LIMIT 1");
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$username)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		
		if($query->num_rows == 1){
			if(!$query->bind_result($id,$hashedPassword,$securityLevel)) throw new Exception($this->db->error);
			$query->fetch();
			if(password_verify($password,$hashedPassword)){
				$loginType = $securityLevel == 0 ? "general" : "admin";
				$_SESSION["id"] 	  = $id;
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				$_SESSION["type"] 	  = $loginType;
			}
		}	
		
		return $loginType;
	}
	
	function userExists($username){
		$exists = false;

		$query = $this->db->prepare("SELECT id FROM User WHERE username = ? LIMIT 1");
		if(!$query) throw new Exception($this->db->error);
		if(!$query->bind_param("s",$username)) throw new Exception($this->db->error);
		if(!$query->execute()) throw new Exception($this->db->error);
		if(!$query->store_result()) throw new Exception($this->db->error);
		
		return $query->num_rows == 1;
	}
	
	function create($username,$password,$type){
		$success = false;
		if($this->isLogged() && $_SESSION["type"] == "admin"){
			if(!$this->userExists($username)){
				$securityLevel = $type == "general" ? 0 : 1;  
				$hashedPassword = password_hash($password,PASSWORD_DEFAULT);
				$insert = $this->db->prepare("INSERT INTO User (username,password,securityLevel) VALUES (?,?,?)");
		
				if(!$insert) throw new Exception($this->db->error);	
				if(!$insert->bind_param("sss",$username,$hashedPassword,$type)) throw new Exception($this->db->error);
				if(!$insert->execute()) throw new Exception($this->db->error);
				
				$_SESSION["id"] = $insert->insert_id;
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				$_SESSION["type"] 	  = $type;
				$success = true;
			}			
		}
		return $success;
	}
	
	/*
	 * 	FUNCTION 	: isLogged
	 *
	 * 	DESCRIPTION : This function tests if user is currently logged in
	 *
	 * 	PARAMETERS 	: none
	 *
	 * 	RETURNS 	: true if user is logged in, false if not
	 */	
	function isLogged(){		
		$logged = false;		
		if(isset($_SESSION["id"])){
			$query = $this->db->prepare("SELECT password FROM User WHERE id = ? LIMIT 1");
			if(!$query) throw new Exception($this->db->error);
			if(!$query->bind_param("i",$_SESSION["id"])) throw new Exception($this->db->error);
			if(!$query->execute()) throw new Exception($this->db->error);
			if(!$query->store_result()) throw new Exception($this->db->error);

			if($query->num_rows == 1){
				if(!$query->bind_result($hashedPassword)) throw new Exception($this->db->error);
				
				$query->fetch();
				if(password_verify($_SESSION["password"],$hashedPassword)){
					$logged = true;
				}
			}				
		}
		
		return $logged;
	}
	
	function logout(){
		session_destroy();
	}
}



?>