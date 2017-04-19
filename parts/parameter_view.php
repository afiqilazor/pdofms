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

    <a class="btn btn-primary btn-sm" href="main.php?page=parameter_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New Fish Parameter</a>
    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM parameter_detail WHERE pd_head != 'user' and pd_head != 'payroll'";
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID</th>
                    <th class=text-left>Detail</th>
                    <th class=text-right>Value (Digit)</th>
                    <th class=text-center></th>
                </tr>

            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $status = "";

                if($row['pd_head'] != 'fish'){
                    $status = "danger";
                }

                echo 
                  "<tr class=\"".$status."\">"
                . "<td align=middle>"       . $row['pd_id']
                . "</td><td align=left>"    . $row['pd_detail'] 
                . "</td><td align=right>"    . $row['pd_value_digit'] 
                . "</td><td align=right> "  . '<a class="btn btn-primary btn-xs" href="main.php?page=parameter_edit&id='.$row['pd_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>' 
                //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=vessel_delete&id='.$row['vessel_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




