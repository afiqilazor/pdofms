<?php

	require('./connection/connect.php');

	$user_name = preg_replace('/\s+/', '', $_POST['user_name']);
	$user_fullname = $_POST['user_fullname'];
	$user_ic = $_POST['user_ic'];
	$user_pd_value = $_POST['user_pd_value'];

	$query = "SELECT count(*) AS count FROM user where user_name='$user_name' OR user_ic='$user_ic'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The user already existed.'); location.href='main.php?page=user_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO user 

		(
			user_name,
			user_fullname,
			user_ic,
			user_password,
			user_pd_value
		) 

		VALUES 

		(
			'$user_name',
			'$user_fullname',
			'$user_ic',
			'1234',
			'$user_pd_value'
		)";

		mysql_query($sql);

		echo "<script>alert('New user $user_name has been added.'); location.href='main.php?page=user_view';</script>";		

	}



?>