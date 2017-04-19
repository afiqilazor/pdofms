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

    <a class="btn btn-primary btn-sm" href="main.php?page=vessel_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Vessel</a>
    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $user_name = $_SESSION['user_name'];

            $query = "SELECT * FROM vessel";

            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID.</th>
                    <th class=text-left>Vessel Code</th>
                    <th class=text-center>Capacity</th>
                    <th class=text-center></th>
                </tr>

            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $vessel_id = $row['vessel_id'];
                $vessel_max_capacity = $row['vessel_max_capacity'];

                $query_crew = "SELECT count(*) AS count FROM crew WHERE vessel_id='$vessel_id'";
                $result_crew = mysql_query($query_crew);
                $row_crew = mysql_fetch_assoc($result_crew);

                $vessel_current_capacity = $row_crew['count'];

                if($vessel_current_capacity==$vessel_max_capacity){
                    $status = "<font color=\"red\">FULL! (Max: ".$vessel_max_capacity.")</font>";    
                } else {
                    $status = $vessel_current_capacity."/".$vessel_max_capacity;
                }

                echo 
                  "<tr>"
                . "<td align=middle>"       . $vessel_id
                . "</td><td align=left>"    . $row['vessel_code'] 
                . "</td><td align=middle>"  . $status
                . "</td><td align=right> "  . '<a class="btn btn-primary btn-xs" href="main.php?page=vessel_edit&id='.$row['vessel_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>' 
                //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=vessel_delete&id='.$row['vessel_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




