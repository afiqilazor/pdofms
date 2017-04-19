<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function populate(s1){
            var s1 = document.getElementById(s1);
            window.location.assign("main.php?page=trip_add&vessel_id="+s1.value);
        }

        function populate2(s1){
            var s1 = document.getElementById(s1);
            var s2 = document.getElementById('vessel_id');
            window.location.assign("main.php?page=trip_add&vessel_id="+s2.value+"&trip_type="+s1.value);
        }
    </script>

    <script>
        $(document).ready(function(){
            <?php
                require('./connection/connect.php');

                if(isset($_GET['vessel_id']) && isset($_GET['trip_type'])){

                    $vessel_id = $_GET['vessel_id'];
                    $trip_type = $_GET['trip_type'];

                    $type = "period_day";
                    if($trip_type == '1'){
                        $type = "maturity_day";
                    }

                    $query_parameter = "SELECT * FROM parameter_detail WHERE pd_head='trap' AND pd_code='$type'";
                    $query_result = mysql_query($query_parameter);
                    $row_result = mysql_fetch_assoc($query_result);

                    echo "console.log(\"".$query_parameter."\");";

                    if($trip_type == '1'){
                        $sql = "SELECT * FROM path WHERE vessel_id=$vessel_id AND CURDATE()>DATE_ADD(path_last_date,INTERVAL ".$row_result['pd_value_digit']." day)";
                    } else {
                        $sql = "SELECT * FROM path WHERE vessel_id=$vessel_id AND CURDATE()>DATE_ADD(path_renew_date,INTERVAL ".$row_result['pd_value_digit']." day)";
                    }

                    $result = mysql_query($sql);

                    echo "console.log(\"".$sql."\");";

                    echo "var optionArray = [];";
                    while($row = mysql_fetch_array($result)){
                        $content = $row['path_id']."|".$row['path_code'];
                        echo "optionArray.push(\"".$content."\");";
                    }

                    echo "
                        var s1 = document.getElementById(\"vessel_id\");
                        s1.value = \"".$vessel_id."\";
                        var s2 = document.getElementById(\"path_id\");
                        s2.innerHTML = \"\";
                        var s3 = document.getElementById(\"trip_type\");
                        s3.value = \"".$trip_type."\";
                    ";

                    echo "
                        for(var option in optionArray){
                            var pair = optionArray[option].split(\"|\");
                            var newOption = document.createElement(\"option\");
                            newOption.value = pair[0];
                            newOption.innerHTML = pair[1];
                            s2.options.add(newOption);
                        }
                    ";


                } else if(isset($_GET['vessel_id'])){
                    $vessel_id = $_GET['vessel_id'];
                    $sql = "SELECT * FROM vessel";
                    $result = mysql_query($sql);

                    while($row = mysql_fetch_array($result)){
                        if($vessel_id == $row['vessel_id']){
                            echo "var optionArray = [];";
                            $sql2 = "SELECT * FROM path WHERE vessel_id='$row[vessel_id]'";
                            $result2 = mysql_query($sql2);
                            while($row2 = mysql_fetch_array($result2)){
                                $content = $row2['path_id']."|".$row2['path_code'];
                                echo "optionArray.push(\"".$content."\");";
                            }
                        }
                    }

                    echo "
                        var s1 = document.getElementById(\"vessel_id\");
                        s1.value = \"".$vessel_id."\";
                        var s2 = document.getElementById(\"path_id\");
                        s2.innerHTML = \"\";
                    ";

                    echo "
                        for(var option in optionArray){
                            var pair = optionArray[option].split(\"|\");
                            var newOption = document.createElement(\"option\");
                            newOption.value = pair[0];
                            newOption.innerHTML = pair[1];
                            s2.options.add(newOption);
                        }
                    ";
                }
            ?>
        });
    </script>
</head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Purchase</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=trip_insert" method="post">

            <div class="form-group">
                <label for="vessel_id" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="vessel_id" name="vessel_id" onchange="populate('vessel_id')" required>
                        <?php
                            require('/connection/connect.php');
                            $query = "SELECT * FROM vessel";
                            $result = mysql_query($query);
                            echo "<option value=\"\"></option>";
                            while($row = mysql_fetch_array($result)){
                                echo "<option value=".$row['vessel_id'].">".$row['vessel_code']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="trip_type" class="col-sm-2 control-label">Trip Type</label>
                <div class="col-sm-5">
                    <select class="form-control" id="trip_type" name="trip_type" onchange="populate2('trip_type')" required>
                        <option value=""></option>
                        <option value="1">Collect</option>
                        <option value="2">Renew</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="path_id" class="col-sm-2 control-label">Path Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="path_id" name="path_id" required></select>
                </div>
            </div>

            <div class="form-group">
                <label for="trip_date" class="col-sm-2 control-label">Trip Date</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="trip_date" name="trip_date" placeholder="Trip Date" required>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    <a class="btn btn-primary btn-sm" href="main.php?page=trip_view">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
    
</body>

</html>




