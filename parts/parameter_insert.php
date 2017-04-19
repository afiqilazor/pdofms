<?php

	require('./connection/connect.php');

	$pd_detail = strtoupper($_POST['pd_detail']);

	$query = "SELECT count(*) AS count FROM parameter_detail where pd_detail = '$pd_detail'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['count']>0){

		echo "<script>alert('The parameter already existed.'); location.href='main.php?page=parameter_view';</script>";		

	} else {

		$query_fish = "select max(pd_code) as max from parameter_detail where pd_head = 'fish'";
		$result_fish = mysql_query($query_fish);
		$row_fish = mysql_fetch_assoc($result_fish);

		$max_value = $row_fish['max']+1;

		$sql = 

		"INSERT INTO parameter_detail 

		(
			pd_head,
			pd_code,
			pd_detail
		) 

		VALUES 

		(
			'fish',
			'$max_value',
			'$pd_detail'

		)";

		mysql_query($sql);

		echo "<script>alert('New parameter has been added.'); location.href='main.php?page=parameter_view';</script>";
		
	}


?>