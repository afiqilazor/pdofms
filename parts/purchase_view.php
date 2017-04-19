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

    <?php
        $user_pd_value = $_SESSION['user_pd_value'];
        if($user_pd_value != 3){
            echo "<a class=\"btn btn-primary btn-sm\" href=\"main.php?page=purchase_add\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> Add New Purchase</a>";
            echo "<br><br>";
        }
    ?>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            if($user_pd_value != 3){
                $th = "<th class=text-center></th>";
                $query = "SELECT * FROM purchase";
            } else {
                $th = "";
                $query = "SELECT * FROM purchase WHERE user_id = '$_SESSION[user_id]'";
            }
            
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";


            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID.</th>
                    <th class=text-center>Trip ID</th>
                    <th class=text-center>Customer</th>
                    <th class=text-center>Fish Code</th>
                    <th class=text-center>Purchase (kg)</th>
                    <th class=text-right>Purchase Price (RM)</th>"
                    .$th.
                "</tr>
                
            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $query_user = "SELECT * FROM user WHERE user_id='$row[user_id]'";
                $result_user = mysql_query($query_user);
                $row_user = mysql_fetch_assoc($result_user);

                $query_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$row[fish_pd_code]'";
                $result_fish = mysql_query($query_fish);
                $row_fish = mysql_fetch_assoc($result_fish);

                $td = "";
                if($user_pd_value != 3){
                    $td = "</td><td align=right>"   . '<a class="btn btn-primary btn-xs" href="main.php?page=purchase_edit&id='.$row['purchase_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>';
                }
                
                echo 
                  "<tr>"
                . "<td align=middle>"       . $row['purchase_id']
                . "</td><td align=middle>"  . $row['trip_id'] 
                . "</td><td align=middle>"  . $row_user['user_fullname'] 
                . "</td><td align=middle>"  . $row_fish['pd_detail'] 
                . "</td><td align=middle>"  . $row['purchase_kg'] 
                . "</td><td align=right>"   . $row['purchase_price_rm'] 
                .  $td
                //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=purchase_delete&id='.$row['purchase_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




