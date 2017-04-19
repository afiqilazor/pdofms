<?php

	require('./connection/connect.php');

	$vessel_id = $_POST['vessel_id'];
	$path_id = $_POST['path_id'];
	$trip_date = $_POST['trip_date'];
	$trip_type = $_POST['trip_type'];

	$query = "SELECT count(*) AS count FROM trip where trip_date='$trip_date' and vessel_id='$vessel_id' and trip_type='$trip_type'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('Duplicate trip detected.'); location.href='main.php?page=trip_view';</script>";		

	} else {

		$main_sql = 

		"INSERT INTO trip 

		(
			path_id,
			trip_date,
			vessel_id,
			trip_type
		) 

		VALUES 

		(
			'$path_id',
			'$trip_date',
			'$vessel_id',
			'$trip_type'
		)";

		mysql_query($main_sql);

		if($trip_type == '1'){
			$update_path_sql = 

			"UPDATE path

			SET
				path_last_date='$trip_date'

			WHERE path_id = '$path_id'";
		} else {
			$update_path_sql = 

			"UPDATE path

			SET
				path_renew_date='$trip_date'

			WHERE path_id = '$path_id'";
		}


		mysql_query($update_path_sql);

		echo "<script>alert('New trip has been assigned.'); location.href='main.php?page=trip_view';</script>";		

	}



?>