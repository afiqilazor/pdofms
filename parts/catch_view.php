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

    <a class="btn btn-primary btn-sm" href="main.php?page=catch_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Catch</a>
    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM catch ORDER by trip_id DESC";
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>Trip ID</th>
                    <th class=text-center>Fish Code</th>
                    <th class=text-center>Catch (kg)</th>
                    <th class=text-center></th>
                </tr>

            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $query_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$row[fish_pd_code]'";
                $result_fish = mysql_query($query_fish);
                $row_fish = mysql_fetch_assoc($result_fish);

                echo 
                  "<tr>"
                . "<td align=middle>"       . $row['trip_id'] 
                . "</td><td align=middle>"  . $row_fish['pd_detail']
                . "</td><td align=middle>"  . $row['catch_kg'] 
                . "</td><td align=right> "  . '<a class="btn btn-primary btn-xs" href="main.php?page=catch_edit&id='.$row['catch_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>' 
                //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=catch_delete&id='.$row['catch_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




