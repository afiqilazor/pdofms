<?php

	require('./connection/connect.php');

	$fish_pd_code = $_POST['fish_pd_code'];
	$fish_price = $_POST['fish_price'];
	$user_id = $_POST['user_id'];

	$query = "SELECT count(*) AS count FROM fish where fish_pd_code='$fish_pd_code' AND user_id='$user_id'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The price already existed.'); location.href='main.php?page=fish_view';</script>";		

	} else {

		$sql = 

		"INSERT INTO fish 

		(
			fish_pd_code,
			fish_price,
			user_id
		) 

		VALUES 

		(
			'$fish_pd_code',
			'$fish_price',
			'$user_id'
		)";

		mysql_query($sql);

		echo "<script>alert('New price has been added.'); location.href='main.php?page=fish_view';</script>";		

	}



?>