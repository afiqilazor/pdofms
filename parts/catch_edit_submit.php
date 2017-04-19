<?php

	require('./connection/connect.php');

	$catch_id = $_GET['id'];
	$trip_id = $_POST['trip_id'];
	$fish_pd_code = $_POST['fish_pd_code'];
	$catch_kg = $_POST['catch_kg'];

	$sql = 

	"UPDATE catch 

	Set 
		trip_id='$trip_id',
		fish_pd_code='$fish_pd_code',
		catch_kg='$catch_kg'

	where catch_id='$catch_id'";

	mysql_query($sql);

	echo "<script>alert('Catch has been edited.'); location.href='main.php?page=catch_view';</script>";

?>