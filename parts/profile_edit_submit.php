<?php

	require('./connection/connect.php');

	$user_id = $_GET['id'];
	$user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

	$sql = 

	"UPDATE user 

	Set 
		user_name='$user_name',
		user_password='$user_password'

	where user_id='$user_id'";

	mysql_query($sql);

	echo "<script>alert('Profile updated. Please login again with the new credentials.'); location.href='./connection/logout.php';</script>";

?>