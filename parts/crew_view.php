<!DOCTYPE html>
<html lang="en">

<head>
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table1').dataTable();
        });
</script>
</head>

<body>

    <a class="btn btn-primary btn-sm" href="main.php?page=crew_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Crew</a>
    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM crew ORDER BY vessel_id ASC";
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID.</th>
                    <th class=text-left>Crew Name</th>
                    <th class=text-center>NRIC</th>
                    <th class=text-center>Vessel Code</th>
                    <th class=text-center>Is Captain?</th>
                    <th class=text-center>Partitions</th>
                    <th class=text-center></th>
                </tr>

            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                if($row['crew_ic_no'] != 'system'){
                    $query_vessel = "SELECT * FROM vessel WHERE vessel_id='$row[vessel_id]'";
                    $result_vessel = mysql_query($query_vessel);
                    $row_vessel = mysql_fetch_assoc($result_vessel);

                    $iscaptain = $row['crew_is_captain'] == "1" ? "YES" : "NO";

                    echo 
                      "<tr>"
                    . "<td align=middle>"       . $row['crew_id']
                    . "</td><td align=left>"    . $row['crew_name'] 
                    . "</td><td align=middle>"  . $row['crew_ic_no'] 
                    . "</td><td align=middle>"  . $row_vessel['vessel_code'] 
                    . "</td><td align=middle>"  . $iscaptain 
                    . "</td><td align=middle>"  . $row['crew_partition'] 
                    . "</td><td align=right> "  . '<a class="btn btn-primary btn-xs" href="main.php?page=crew_edit&id='.$row['crew_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>' 
                    //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=crew_delete&id='.$row['crew_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                    . "</td></tr>";
                }


            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




