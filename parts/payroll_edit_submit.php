<?php

	require('./connection/connect.php');

	$vessel_id = $_GET['id'];
	$vessel_code = $_POST['vessel_code'];
	$vessel_max_capacity = $_POST['vessel_max_capacity'];

	$sql = 

	"UPDATE vessel 

	Set 
		vessel_code='$vessel_code',
		vessel_max_capacity='$vessel_max_capacity'

	where vessel_id='$vessel_id'";

	mysql_query($sql);

	echo "<script>alert('Vessel $_POST[vessel_code] has been edited.'); location.href='main.php?page=vessel_view';</script>";

?>