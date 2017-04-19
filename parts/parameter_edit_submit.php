<?php

	require('./connection/connect.php');

	$id = $_GET['id'];
	$pd_detail = $_POST['pd_detail'];
	$pd_value_digit = $_POST['pd_value_digit'];

	$pd_value_digit = $pd_value_digit == null ? "" : $pd_value_digit;

	$sql = 

	"UPDATE parameter_detail 

	Set 
		pd_detail='$pd_detail',
		pd_value_digit='$pd_value_digit'

	where pd_id='$id'";

	mysql_query($sql);

	echo "<script>alert('Parameter has been edited.'); location.href='main.php?page=parameter_view';</script>";

?>