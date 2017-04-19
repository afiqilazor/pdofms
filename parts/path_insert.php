<?php

	require('./connection/connect.php');

	$path_code = $_POST['path_code'];
	$vessel_id = $_POST['vessel_id'];

	$query = "SELECT count(*) AS count FROM path where path_code='$path_code'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The path already existed.'); location.href='main.php?page=path_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO path 

		(
			path_code,
			vessel_id,
			path_renew_date,
			path_last_date
		) 

		VALUES 

		(
			'$path_code',
			'$vessel_id',
			'2010-01-01',
			'2010-01-01'
		)";

		mysql_query($sql);

		echo "<script>alert('New path has been added.'); location.href='main.php?page=path_view';</script>";		

	}



?>