<?php

	require('./connection/connect.php');

    $id = $_GET['id'];
    mysql_query("DELETE FROM vessel WHERE vessel_id = $id");

    header("location:main.php?page=vessel_view");
?>