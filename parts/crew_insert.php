<?php

	require('./connection/connect.php');

	$crew_name = $_POST['crew_name'];
	$crew_ic_no = $_POST['crew_ic_no'];
	$vessel_id = $_POST['vessel_id'];
	$crew_is_captain = $_POST['crew_is_captain'];
	$crew_partition = $_POST['crew_partition'];

	$query = "SELECT count(*) AS count FROM crew where crew_ic_no='$crew_ic_no'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The crew already existed.'); location.href='main.php?page=crew_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO crew 

		(
			crew_name,
			crew_ic_no,
			vessel_id,
			crew_is_captain,
			crew_partition
		) 

		VALUES 

		(
			'$crew_name',
			'$crew_ic_no',
			'$vessel_id',
			'$crew_is_captain',
			'$crew_partition'
		)";

		mysql_query($sql);

		echo "<script>alert('New crew added.'); location.href='main.php?page=crew_view';</script>";		

	}



?>