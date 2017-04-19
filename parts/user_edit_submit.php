<?php

	require('./connection/connect.php');

	$user_id = $_GET['id'];
    $user_name = $_POST['user_name'];
    $user_fullname = $_POST['user_fullname'];
    $user_ic = $_POST['user_ic'];
    $user_pd_value = $_POST['user_pd_value'];
	$sql = 

	"UPDATE user 

	Set 
		user_fullname='$user_fullname',
		user_pd_value='$user_pd_value'

	where user_id='$user_id'";

	mysql_query($sql);

	echo "<script>alert('User $user_name has been edited.'); location.href='main.php?page=user_view';</script>";

?>