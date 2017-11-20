<?php
session_start();

// Login to doctors account
function loginfunction($username,$password)
{
	//LOGIN QUERY
$resultlogin = mysql_query("SELECT * FROM doctor WHERE name ='$username' AND password='$password' ");
// LOGIN VALIDATON
	if(mysql_num_rows($resultlogin) == 1)
	{
 	$_SESSION["username"] =$username;
	$_SESSION["usertype"] = "DOCTOR";
	}
	else
	{
	$in= "Invalid Login ID or invalid password. ";
	return $in;
	}
}
?>
