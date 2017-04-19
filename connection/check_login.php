<?php
	session_start();
	require('connect.php');

	if(isset($_POST['username']) and isset($_POST['password'])){
		$user_name = $_POST['username'];
		$user_password = $_POST['password'];

		$query = "SELECT * FROM user WHERE user_name='$user_name' and user_password='$user_password'";

		$result = mysql_query($query) or die(mysql_error());
		$count = mysql_num_rows(($result));

		$result = mysql_query($query);
        $row = mysql_fetch_assoc($result);

        $user_fullname = $row['user_fullname'];
        $user_pd_value = $row['user_pd_value'];
        $user_id = $row['user_id'];

		if($count==1){
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_fullname'] = $user_fullname;
			$_SESSION['user_pd_value'] = $user_pd_value;

			if($user_pd_value == 3){
				header("location:../main.php?page=purchase_view");
			} else {
				header("location:../main.php?page=dashboard");
			}
		}else{
			header("location:../index.php?error=1");
		}
	}
?>