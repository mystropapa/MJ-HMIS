<?php

require '../ac/core/config.db.php';
/*
	Sample Processing of Forgot password form via ajax
	Page: extra-register.html
*/

# Response Data Array
$resp = array();


// Fields Submitted
$username = filterData($_POST["username"]);
$password = filterData($_POST["password"]);


// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
$resp['submitted_data'] = $_POST;


// Login success or invalid login data [success|invalid]
// Your code will decide if username and password are correct
$login_status = 'invalid';

$getUser=getUserByEmailAndPassword($username, $password);
if($getUser['status']==1)
{
	$resp[] = $getUser;

}else{
	$resp[] = $getUser;
	$resp['status_msg'] = $getUser['status_msg'];
}

$resp['login_status'] = $getUser['status'];



// Login Success URL
if($resp['login_status'] == 1)
{
	// If you validate the user you may set the user cookies/sessions here
		#setcookie("logged_in", "user_id");
		#$_SESSION["logged_user"] = "user_id";
	
	// Set the redirect url after successful login
	$resp['redirect_url'] = 'index.php';
}else{
	$login_status = 0;
}


echo json_encode($resp);