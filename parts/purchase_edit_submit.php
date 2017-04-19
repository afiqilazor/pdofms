<?php

	require('./connection/connect.php');

	$purchase_id = $_GET['id'];
    $purchase_kg = $_POST['purchase_kg'];

	$sql = 

	"UPDATE purchase 

	Set 
		purchase_kg='$purchase_kg'

	where purchase_id='$purchase_id'";

	mysql_query($sql);

	echo "<script>alert('Purchase has been edited.'); location.href='main.php?page=purchase_view';</script>";

?>