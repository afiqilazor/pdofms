<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function populate(s1){
            var s1 = document.getElementById(s1);
            window.location.assign("main.php?page=purchase_add&trip_id="+s1.value);
        }

        function populate2(s1){
            var s1 = document.getElementById('trip_id');
            var s2 = document.getElementById('fish_pd_code');
            window.location.assign("main.php?page=purchase_add&trip_id="+s1.value+"&fish_pd_code="+s2.value);
        }
    </script>

    <script>
        $(document).ready(function(){
            <?php
                require('./connection/connect.php');

                if(isset($_GET['trip_id']) && isset($_GET['fish_pd_code'])){

                    $trip_id = $_GET['trip_id'];
                    $fish_pd_code = $_GET['fish_pd_code'];
                    
                    $sql = "SELECT * FROM catch WHERE trip_id='$trip_id'";
                    $result = mysql_query($sql);

                    echo "var optionArray = [];";
                    echo "optionArray.push(\" | \");";
                    
                    while($row = mysql_fetch_array($result)){

                        $sql_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$row[fish_pd_code]'";
                        $result_fish = mysql_query($sql_fish);
                        $row_fish = mysql_fetch_assoc($result_fish);

                        $sql_balance = "SELECT sum(purchase_kg) AS sum  FROM purchase WHERE trip_id = '$trip_id' AND fish_pd_code='$row[fish_pd_code]'";
                        $result_balance = mysql_query($sql_balance);
                        $row_balance = mysql_fetch_assoc($result_balance);

                        $balance_catch = $row['catch_kg']-$row_balance['sum'];

                        if($balance_catch>0){
                            $display = $row_fish['pd_detail']." (".$balance_catch." kg remaining)";
                            
                            $content = $row['fish_pd_code']."|".$display;
                            echo "optionArray.push(\"".$content."\");";
                        }

                    }

                    $query_catch2 = "SELECT sum(catch_kg) as sum FROM catch WHERE trip_id='$trip_id' AND fish_pd_code='$fish_pd_code'";
                    $result_catch2 = mysql_query($query_catch2);
                    $row_catch2 = mysql_fetch_assoc($result_catch2);

                    $query_purchase2 = "SELECT sum(purchase_kg) as sum2 FROM purchase WHERE trip_id='$trip_id' AND fish_pd_code='$fish_pd_code'";
                    $result_purchase2 = mysql_query($query_purchase2);
                    $row_purchase2 = mysql_fetch_assoc($result_purchase2);

                    $balance_new = $row_catch2['sum']-$row_purchase2['sum2'];

                    echo "console.log(\"".$balance_new."\");";
                    echo "console.log(\"".$fish_pd_code."\");";

                    echo "
                        var s1 = document.getElementById(\"trip_id\");
                        s1.value = \"".$trip_id."\";

                        var s2 = document.getElementById(\"fish_pd_code\");
                        

                        var s3 = document.getElementById(\"purchase_kg\");
                        s3.max = \"".$balance_new."\";
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

                    echo "
                        s2.value = \"".$_GET['fish_pd_code']."\";
                    ";
                }

                else if(isset($_GET['trip_id'])){
                    
                    $trip_id = $_GET['trip_id'];

                    $sql = "SELECT * FROM catch WHERE trip_id='$trip_id'";
                    $result = mysql_query($sql);

                    echo "var optionArray = [];";
                    echo "optionArray.push(\" | \");";
                    
                    while($row = mysql_fetch_array($result)){

                        $sql_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$row[fish_pd_code]'";
                        $result_fish = mysql_query($sql_fish);
                        $row_fish = mysql_fetch_assoc($result_fish);

                        $sql_balance = "SELECT sum(purchase_kg) AS sum  FROM purchase WHERE trip_id = '$trip_id' AND fish_pd_code='$row[fish_pd_code]'";
                        $result_balance = mysql_query($sql_balance);
                        $row_balance = mysql_fetch_assoc($result_balance);

                        $balance_catch = $row['catch_kg']-$row_balance['sum'];

                        if($balance_catch>0){
                            $display = $row_fish['pd_detail']." (".$balance_catch." kg remaining)";
                            
                            $content = $row['fish_pd_code']."|".$display;
                            echo "optionArray.push(\"".$content."\");";
                        }

                    }

                    echo "
                        var s1 = document.getElementById(\"trip_id\");
                        s1.value = \"".$trip_id."\";
                        var s2 = document.getElementById(\"fish_pd_code\");
                        s2.innerHTML = \"\";
                        var s3 = document.getElementById(\"purchase_kg\");
                        s3.max = \"".$balance_catch."\";
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
        <form class="form-horizontal" action="main.php?page=purchase_insert" method="post">

            
            <div class="form-group">
                <label for="trip_id" class="col-sm-2 control-label">Trip ID</label>
                <div class="col-sm-5">
                    <select class="form-control" id="trip_id" name="trip_id" onchange="populate('trip_id')" required>
                        <?php
                            $query = "SELECT * FROM trip";
                            $result = mysql_query($query);
                            echo "<option value=\"\"></option>";
                            while($row = mysql_fetch_array($result)){
                                echo "<option value=".$row['trip_id'].">".$row['trip_id']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="fish_pd_code" class="col-sm-2 control-label">Fish Name</label>
                <div class="col-sm-5">
                    <select class="form-control" id="fish_pd_code" name="fish_pd_code" onchange="populate2('fish_pd_code')" required></select>
                </div>
            </div>

            <div class="form-group">
                <label for="purchase_kg" class="col-sm-2 control-label">Total Purchase (kg)</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="purchase_kg" name="purchase_kg" min="0" max="" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" placeholder="" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_id" class="col-sm-2 control-label">Customer</label>
                <div class="col-sm-5">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <?php
                            $query = "SELECT * FROM user WHERE user_pd_value='3'";
                            $result = mysql_query($query);
                            echo "<option value=\"\"></option>";
                            while($row = mysql_fetch_array($result)){
                                echo "<option value=".$row['user_id'].">".$row['user_fullname']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    <a class="btn btn-primary btn-sm" href="main.php?page=purchase_view">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
    
</body>

</html>




