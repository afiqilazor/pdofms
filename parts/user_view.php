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

    <a class="btn btn-primary btn-sm" href="main.php?page=user_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New User</a>
    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM user ORDER BY user_pd_value ASC";
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID</th>
                    <th class=text-left>User Name</th>
                    <th class=text-left>Full Name</th>
                    <th class=text-center>NRIC</th>
                    <th class=text-center>User Level</th>
                    <th class=text-center></th>
                </tr>
                
            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {
                $user_id = $row['user_id'];
                $level = "CUSTOMER";
                $delete = "";

                if($_SESSION['user_pd_value']!="3"){
                    $delete = '<a class="btn btn-primary btn-xs" href="main.php?page=user_delete&id='.$row['user_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
                }

                if($row['user_pd_value']=="1"){
                    $level = "ADMINISTRATOR";
                }


                echo 
                  "<tr>"
                . "<td align=middle>"         . $count++ 
                . "</td><td align=left>"      . $row['user_name'] 
                . "</td><td align=left>"      . $row['user_fullname'] 
                . "</td><td align=middle>"    . $row['user_ic'] 
                . "</td><td align=middle>"    . $level
                . "</td><td align=right>"     . '<a class="btn btn-primary btn-xs" href="main.php?page=user_edit&id='.$row['user_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>' 
                . " "                         . ""
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




