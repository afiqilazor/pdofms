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
            echo "<a class=\"btn btn-primary btn-sm\" href=\"main.php?page=trip_add\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> Add New Trip</a>";
            echo "<br><br>";
        }
    ?>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');


            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            if($user_pd_value != 3){
                $th = "<th class=text-center>ID.</th>
                    <th class=text-center>Path</th>
                    <th class=text-center>Trip Date</th>
                    <th class=text-center>Trip Type</th>
                    <th class=text-center>Vessel Code</th>
                    <th class=text-center>Crews ID</th>
                    <th class=text-left>Booked by</th>
                    <th class=text-center></th>";
                $query = "SELECT * FROM trip";
            } else {
                $th = "<th class=text-center>Trip Date</th>
                    <th class=text-center>Vessel Code</th>
                    <th class=text-center>Booked (times)</th>
                    <th class=text-center></th>";
                $query = "SELECT * FROM trip WHERE trip_date>DATE_ADD(CURDATE(),INTERVAL 3 day)";
            }

            $result = mysql_query($query);

            echo 
            "<thead>
                <tr>
                    ".$th."
                </tr>
            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $user_array = explode(',', $row['trip_book_user_id']);

                $total_book = 0;
                $booked = 0;
                $book_list = "";
                $count = 1;
                foreach ($user_array as $user) {
                    if($user != ""){

                        $query_user = "SELECT * FROM user WHERE user_id = '$user'";
                        $result_user = mysql_query($query_user);
                        $row_user = mysql_fetch_assoc($result_user);

                        $book_list = $book_list.$count++.".".$row_user['user_name']."<br>";

                        if($user == $_SESSION['user_id']){
                            $booked = 1;
                        }
                        $total_book++;
                    }
                }

                $query_path = "SELECT * FROM path WHERE path_id = '$row[path_id]'";
                $result_path = mysql_query($query_path);
                $row_path = mysql_fetch_assoc($result_path);

                $query_vessel = "SELECT * FROM vessel WHERE vessel_id = '$row[vessel_id]'";
                $result_vessel = mysql_query($query_vessel);
                $row_vessel = mysql_fetch_assoc($result_vessel);

                $trip_type = $row['trip_type'] == '1' ? "COLLECT" : "RENEW" ;

                if($user_pd_value != 3){
                    echo 
                      "<tr>"
                    . "<td align=middle>"       . $row['trip_id'] 
                    . "</td><td align=middle>"  . $row_path['path_code'] 
                    . "</td><td align=middle>"   . $row['trip_date'] 
                    . "</td><td align=middle>"   . $trip_type 
                    . "</td><td align=middle>"   . $row_vessel['vessel_code'] 
                    . "</td><td align=middle>"   . $row['trip_crew'] 
                    . "</td><td align=left>"   . $book_list
                    . "</td><td align=right>"   . '<a class="btn btn-primary btn-xs" href="main.php?page=trip_edit&id='.$row['trip_id'].'&vessel_id='.$row['vessel_id'].'&path_id='.$row['path_id'].'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Edit</a>' 
                    . "</td></tr>";
                } else {

                    if($trip_type != 2){
                        if($booked == 1){
                            echo 
                              "<tr>"
                            . "</td><td align=middle>"   . $row['trip_date'] 
                            . "</td><td align=middle>"   . $row_vessel['vessel_code'] 
                            . "</td><td align=left>"   . $total_book 
                            . "</td><td align=right>"    . '<a class="btn btn-primary btn-xs btn-danger" href="main.php?page=book_delete&id='.$row['trip_id'].'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</a>' 
                            //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=trip_delete&id='.$row['trip_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                            . "</td></tr>";
                        } else {
                            echo 
                              "<tr>"
                            . "</td><td align=middle>"   . $row['trip_date'] 
                            . "</td><td align=middle>"   . $row_vessel['vessel_code'] 
                            . "</td><td align=middle>"   . $total_book 
                            . "</td><td align=right>"    . '<a class="btn btn-primary btn-xs" href="main.php?page=book_add&id='.$row['trip_id'].'"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Book</a>' 
                            //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=trip_delete&id='.$row['trip_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                            . "</td></tr>";
                        }
                    }

                }

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




