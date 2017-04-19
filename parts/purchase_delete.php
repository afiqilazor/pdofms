<?php

	require('./connection/connect.php');

    $id = $_GET['id'];
    mysql_query("DELETE FROM fish WHERE fish_id = $id");

    header("location:main.php?page=fish_view");
?>