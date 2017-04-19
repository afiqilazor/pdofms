<!DOCTYPE html>
<html lang="en">

<head>
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table1').dataTable({
            });
        });
</script>
</head>

<body>

    <a class="btn btn-primary btn-sm" href="main.php?page=path_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Path</a>
    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM path";
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID.</th>
                    <th class=text-left>Path Code</th>
                    <th class=text-center>Traps last renewed on</th>
                    <th class=text-center>Path last used on</th>
                    <th class=text-center>Vessel Code</th>
                    <th class=text-center></th>
                </tr>
                
            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $query_vessel = "SELECT * from vessel WHERE vessel_id = '$row[vessel_id]'";
                $query_vessel = mysql_query($query_vessel);
                $row_vessel = mysql_fetch_assoc($query_vessel);

                echo 
                  "<tr>"
                . "<td align=middle>"       . $row['path_id']
                . "</td><td align=left>"    . $row['path_code'] 
                . "</td><td align=middle>"   . $row['path_renew_date'] 
                . "</td><td align=middle>"   . $row['path_last_date'] 
                . "</td><td align=middle>"   . $row_vessel['vessel_code'] 
                . "</td><td align=right>"   . '<a class="btn btn-primary btn-xs" href="main.php?page=path_edit&id='.$row['path_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>' 
                //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=path_delete&id='.$row['path_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




