<?php

	require('./connection/connect.php');

	$path_id = $_GET['id'];
    $vessel_id = $_POST['vessel_id'];

	$sql = 

	"UPDATE path 

	Set 
		vessel_id='$vessel_id'

	where path_id='$path_id'";

	mysql_query($sql);

	echo "<script>alert('Path has been edited.'); location.href='main.php?page=path_view';</script>";

?>