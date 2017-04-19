<?php

	require('./connection/connect.php');

	$trip_id = $_GET['id'];
	$trip_date = $_POST['trip_date'];
    $vessel_id = $_POST['vessel_id'];
    $path_id = $_POST['path_id'];
    $trip_crew = $_POST['trip_crew'];

	$sql = 

	"UPDATE trip 

	Set 
		trip_date='$trip_date',
		vessel_id='$vessel_id',
		path_id='$path_id',
		trip_crew = '$trip_crew'

	where trip_id='$trip_id'";

	mysql_query($sql);

	$update_path_sql =

	"UPDATE path

	Set
		path_last_date='$trip_date'

	WHERE path_id='$path_id'";

	mysql_query($update_path_sql);

	echo "<script>alert('Trip has been edited.'); location.href='main.php?page=trip_view';</script>";

?>