<?php

	require('./connection/connect.php');

	$crew_id = $_GET['id'];
	$crew_name = $_POST['crew_name'];
	$vessel_id = $_POST['vessel_id'];
	$crew_is_captain = $_POST['crew_is_captain'];
	$crew_partition = $_POST['crew_partition'];

	$query = 

	"UPDATE crew 

	Set 
		crew_name='$crew_name',
		vessel_id='$vessel_id',
		crew_is_captain='$crew_is_captain',
		crew_partition='$crew_partition'

	where crew_id='$crew_id'";

	mysql_query($query);

	echo "<script>alert('Crew has been edited.'); location.href='main.php?page=crew_view';</script>";

?>