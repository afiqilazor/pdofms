<?php

	require('./connection/connect.php');

	$user_id = $_SESSION['user_id'];
    $id = $_GET['id'];
    
    $query = "SELECT * FROM trip WHERE trip_id='$id'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

    $oldlist = $row['trip_book_user_id'];
    $finallist = $oldlist.",".$user_id;

    $sql = 

	"UPDATE trip 

	Set 
		trip_book_user_id='$finallist'

	where trip_id='$id'";

	mysql_query($sql);

    header("location:main.php?page=trip_view");
?>