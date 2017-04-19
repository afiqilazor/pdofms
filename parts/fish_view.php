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
        if($_SESSION['user_pd_value'] != 3){
            echo "<a class=\"btn btn-primary btn-sm\" href=\"main.php?page=fish_add\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> Add New Fish Price</a>";
            echo "<br><br>";
        }
    ?>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $user_id = $_SESSION['user_id'];
            $user_pd_value = $_SESSION['user_pd_value'];

            $fish = "";
            $status = "";
            $customer = "";

            if(isset($_POST['fish'])){
                $fish = $_POST['fish'];
                $status = $_POST['status'];
                $customer = $_POST['customer'];
            }

            if($user_pd_value=="3"){
                $query = "SELECT * from fish WHERE user_id='$user_id'";
            } else {
                $query = "SELECT * FROM fish ORDER BY user_id, fish_price ASC";
            }
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            $th = $user_pd_value == 3 ? "" : "<th class=text-center></th>";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID</th>
                    <th class=text-left>Fish Name</th>
                    <th class=text-right>Price</th>
                    <th class=text-left>User Name</th>"
                    .$th.
                "</tr>
                
            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $fish_id = $row['fish_id'];

                $query_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$row[fish_pd_code]'";
                $result_fish = mysql_query($query_fish);
                $row_fish = mysql_fetch_assoc($result_fish);

                $query_user = "SELECT * FROM user WHERE user_id='$row[user_id]'";
                $result_user = mysql_query($query_user);
                $row_user = mysql_fetch_assoc($result_user);

                $tr = "";
                $tr2 = "";
                if($user_pd_value != 3){
                    $tr = "</td><td align=right>"   . '<a class="btn btn-primary btn-xs" href="main.php?page=fish_edit&id='.$fish_id.'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>';
                    $tr2 = " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=fish_delete&id='.$fish_id.'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>  Delete</a>';
                }

                echo 
                  "<tr>"
                . "<td align=middle>"       . $count++ 
                . "</td><td align=left>"    . $row_fish['pd_detail'] 
                . "</td><td align=right>"   . $row['fish_price'] 
                . "</td><td align=left>"    . $row_user['user_fullname']
                .  $tr
                .  $tr2
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




