<?php

	require('./connection/connect.php');

	$vessel_code = $_POST['vessel_code'];
	$vessel_max_capacity = $_POST['vessel_max_capacity'];

	$query = "SELECT count(*) AS count FROM vessel where vessel_code='$vessel_code'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The vessel already existed.'); location.href='main.php?page=vessel_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO vessel 

		(
			vessel_code,
			vessel_max_capacity
		) 

		VALUES 

		(
			'$vessel_code',
			'$vessel_max_capacity'

		)";

		mysql_query($sql);

		echo "<script>alert('New vessel has been added.'); location.href='main.php?page=vessel_view';</script>";
		
	}


?>