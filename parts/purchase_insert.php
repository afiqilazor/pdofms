<?php

	require('./connection/connect.php');

	$trip_id = $_POST['trip_id'];
	$fish_pd_code = $_POST['fish_pd_code'];
	$purchase_kg = $_POST['purchase_kg'];
	$user_id = $_POST['user_id'];

	$query = "SELECT * FROM fish WHERE fish_pd_code='$fish_pd_code' AND user_id='$user_id'";
    $result = mysql_query($query);

    $count = 0;
    while($row = mysql_fetch_array($result)){
    	$get_price = $row['fish_price'];
    	$count++;
    }

	if($count==0){

		echo "<script>alert('Please set fish price for selected customer.'); location.href='main.php?page=fish_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO purchase 

		(
			trip_id,
			fish_pd_code,
			purchase_kg,
			user_id,
			purchase_price_rm
		) 

		VALUES 

		(
			'$trip_id',
			'$fish_pd_code',
			'$purchase_kg',
			'$user_id',
			'$get_price'
		)";

		mysql_query($sql);

		echo "<script>alert('New purchase added.'); location.href='main.php?page=purchase_view';</script>";		

	}



?>