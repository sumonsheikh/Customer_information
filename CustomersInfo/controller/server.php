<?php 
	
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	

	$errors = array(); 
	$_SESSION['success'] = "";
	include("config.php");
	
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($myconn, $_POST['username']);
		$email = mysqli_real_escape_string($myconn, $_POST['email']);
		$password = mysqli_real_escape_string($myconn, $_POST['password']);
		
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		
		if (count($errors) == 0) {
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO user (uid,username, email, password) 
					  VALUES(NULL,'$username', '$email', '$password')";
			mysqli_query($myconn, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: ../view/index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($myconn, $_POST['username']);
		$password = mysqli_real_escape_string($myconn, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
			$results = mysqli_query($myconn, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: ../view/index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	//Create customer inforamtion

	$email    = "";
	$customerName="";
	$address="";
	$phone="";
	$cid = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$customerName = $_POST['customerName'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];


		mysqli_query($myconn, "INSERT INTO customer_info (cid,customerName, address,email,phone) VALUES (NULL,'$customerName', '$address','$email','$phone')"); 
		$_SESSION['message'] = "Customer inforamtion saved"; 
		header('location: ../view/index.php');
	}

	//Update Customer information
	if (isset($_POST['update'])) {
		$cid = mysqli_real_escape_string($myconn,$_POST['cid']);
		$customerName =mysqli_real_escape_string($myconn,$_POST['customerName']);
		$address = mysqli_real_escape_string($myconn,$_POST['address']);
		$email = mysqli_real_escape_string($myconn,$_POST['email']);
		$phone = mysqli_real_escape_string($myconn,$_POST['phone']);


		mysqli_query($myconn, "UPDATE customer_info SET customerName='$customerName', address='$address',email='$email',phone='$phone' WHERE cid='$cid'");
		

		$_SESSION['message'] = "Customer inforamtion updated!"; 
		header('location: ../view/index.php');
	}

	if (isset($_GET['del'])) {
	$cid = $_GET['del'];
	mysqli_query($myconn, "DELETE FROM customer_info WHERE cid=$cid");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: ../view/index.php');
}


?>