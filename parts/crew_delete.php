<?php

	require('./connection/connect.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM crew WHERE crew_id='$id'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    $vessel_code = $row['vessel_code'];

    mysql_query("DELETE FROM crew WHERE crew_id = $id");
    
    $sql2 = 
    "	UPDATE vessel 
    	SET vessel_current_crew=vessel_current_crew-1
    	WHERE vessel_code='$vessel_code'

    ";

    mysql_query($sql2);

    header("location:main.php?page=crew_view");
?>