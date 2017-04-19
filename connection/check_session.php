<?php
	if(isset($_SESSION['user_name'])){

	} else {
		header("location:../index.php");
	}
?>