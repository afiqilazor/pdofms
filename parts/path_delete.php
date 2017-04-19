<?php

	require('./connection/connect.php');

    $id = $_GET['id'];
    mysql_query("DELETE FROM path WHERE path_id = $id");

    header("location:main.php?page=path_view");
?>