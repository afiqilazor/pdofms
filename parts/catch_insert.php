<?php

	require('./connection/connect.php');

	$trip_id = $_POST['trip_id'];
	$fish_pd_code = $_POST['fish_pd_code'];
	$catch_kg = $_POST['catch_kg'];

	$query = "SELECT count(*) AS count FROM catch where trip_id='$trip_id' and fish_pd_code='$fish_pd_code'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The catch already existed. To add more catch please edit the catch.'); location.href='main.php?page=catch_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO catch 

		(
			trip_id,
			fish_pd_code,
			catch_kg
		) 

		VALUES 

		(
			'$trip_id',
			'$fish_pd_code',
			'$catch_kg'

		)";

		mysql_query($sql);

		echo "<script>alert('New catch has been added.'); location.href='main.php?page=catch_view';</script>";
		
	}


?>