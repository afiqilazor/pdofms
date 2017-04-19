<?php

	require('./connection/connect.php');

	$fish_id = $_GET['id'];
	$fish_price = $_POST['fish_price'];

	$sql = 

	"UPDATE fish 

	Set 
		fish_price=$fish_price

	where fish_id='$fish_id'";

	mysql_query($sql);

	echo "<script>alert('Price has been edited.'); location.href='main.php?page=fish_view';</script>";

?>