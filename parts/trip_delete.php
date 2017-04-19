<?php

	require('./connection/connect.php');

    $id = $_GET['id'];
    mysql_query("DELETE FROM trip WHERE trip_id = $id");

    header("location:main.php?page=trip_view");
?>