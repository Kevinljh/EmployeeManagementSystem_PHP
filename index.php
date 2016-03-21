<?php
	session_start();
	include("php/users.class.php");

	$users = new Users();
	$isLogged = $users->isLogged();
	$userType = $users->userType();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<meta charset="UTF-8">
	<meta name="description" content="Employee Management System">
	<meta name="keywords" content="EMS,Employee,Management,System">
	<meta name="author" content="Ben Lorantfy, Grigoriy Kozyrev, Michael Dasilva, Kevin Li">
	<?php if($isLogged){ ?>
	<meta name="isLogged" content="true"/>
	<?php } ?>
	<meta name="userType" content="<?php echo $userType; ?>"/>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

	<!-- JS -->
	<!-- frameworks -->
	<script src = "js/frameworks/jquery.js"></script>
	<script src = "js/frameworks/jqease.js"></script> 		<!-- Easing for jquery's animate function -->
	<script src = "js/frameworks/msgbox.js"></script> 		<!-- Used to show quick messages to the user (i.e. saved succesfully ) -->
	<script src = "js/frameworks/postcall.js"></script> 	<!-- Used to call php functions from js more easily -->
	<script src = "js/frameworks/customEvent.js"></script> 	<!-- Used to create custom events and event handlers -->

	<!-- modules -->
	<script src = "js/section.class.js"></script>
	<script src = "js/loginbox.class.js"></script>
	<script src = "js/searchbox.class.js"></script>
	<script src = "js/reportsbox.class.js"></script>
	<script src = "js/usersbox.class.js"></script>
	<script src = "js/addEmployeeBox.class.js"></script>

	<!-- JS Entry Point -->
	<script src = "js/main.js"></script>

	<?php if(!$isLogged){ ?>

		<!--
			If user is not logged in, hide the search screen untill the user logs in
		-->
		<style>
			#search{
				display: none;
			}
		</style>

	<?php } ?>

	<?php if($userType != "admin"){ ?>

		<!--
			If user is not admin, hide admin controls
		-->
		<style id = "adminControl">
			.adminControl{
				display: none;
			}
		</style>

	<?php } ?>
</head>
<body>
	<div id = "cover" style="opacity: 0;"></div>

	<?php include("includes/login.php"); ?>
	<?php include("includes/search.php"); ?>
	<?php include("includes/reports.php"); ?>
	<?php include("includes/users.php"); ?>
	<?php include("includes/addEmployee.php"); ?>

</body>
</html>