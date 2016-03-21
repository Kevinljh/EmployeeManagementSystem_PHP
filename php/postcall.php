<?php

/*
 * Postcall Version 1.0.1
 *
 * PostCall is a jquery and php plugin/design pattern that makes 
 * calling a php method from ajax similar to calling a php method from php
 * See https://github.com/BenLorantfy/PostCall for details
 *
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Ben Lorantfy
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
 
if(isset($_POST["class"]) && isset($_POST["method"])){
	$class  	= $_POST["class"];	// class method belongs to
	$method 	= $_POST["method"];	// method to call
	$arguments 	= array();
	
	if(method_exists($class,$method)){
		if(isset($_POST["session"])){
			session_start();			
		}

		array_walk($_POST, function(&$value, &$key) use (&$arguments){
			if(is_numeric($key)){
				if(isset($_POST["json"])){
					array_push($arguments,json_decode($value));
				}else{
					array_push($arguments,$value);
				}
			}
		});	
		
		try{
			if(isset($_POST["json"])){
				$returnData = array("error" => false, "message" => call_user_func_array(array(new $class(),$method), $arguments));
			}else{
				$returnData = call_user_func_array(array(new $class(),$method), $arguments);
			}
			
		}catch(Exception $e){
			if(isset($_POST["json"])){
				$returnData = array("error" => true,"message" => $e->getMessage());	
			}else{
				$returnData = $e->getMessage();
			}
		}	

	}else{
		if(isset($_POST["json"])){
			$returnData = array("error" => true, "message" => "Specified method doesn't exist within specified class");
		}else{
			$returnData = "Specified method doesn't exist within specified class";
		}
	}	
	
	if(isset($_POST["json"])){
		echo json_encode($returnData, JSON_HEX_QUOT | JSON_HEX_TAG);
	}else{
		echo print_r($returnData,true);
	}		
}


?>