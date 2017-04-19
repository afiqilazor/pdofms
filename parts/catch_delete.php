<?php

	require('./connection/connect.php');

    $id = $_GET['id'];
    mysql_query("DELETE FROM catch WHERE catch_id = $id");

    header("location:main.php?page=catch_view");
?>