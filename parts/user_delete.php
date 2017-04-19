<?php

	require('./connection/connect.php');

    $id = $_GET['id'];

    mysql_query("DELETE FROM user WHERE user_id = '$id'");

    header("location:main.php?page=user_view");
?>