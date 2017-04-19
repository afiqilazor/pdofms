<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function populate(s1,id){
            var s1 = document.getElementById(s1);
            var s2 = document.getElementById('path_id');
            window.location.assign("main.php?page=trip_edit&id="+id+"&vessel_id="+s1.value+"&path_id="+s2.value);
        }
    </script>

    <script>
        $(document).ready(function(){
            <?php
                require('./connection/connect.php');

                if(isset($_GET['vessel_id'])){
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

                    echo "s2.value = '".$_GET['path_id']."'";
                }

            ?>
        });
    </script>
</head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Trip</h3>
      </div>
      <div class="panel-body">

        <?php

            $id = $_GET['id'];

            $query = "SELECT * FROM trip where trip_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $trip_id = $row['trip_id'];
            $trip_date = $row['trip_date'];
            $path_id = $row['path_id'];
            $vessel_id = $row['vessel_id'];
            $trip_crew = $row['trip_crew'];

            $trip_type = $row['trip_type'] == '1' ? "Collect" : "Renew";

        ?>

        <form class="form-horizontal" action="main.php?page=trip_edit_submit&id= <?php echo $trip_id ?> " method="post">

            <div class="form-group">
                <label for="trip_date" class="col-sm-2 control-label">Trip Type</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control" id="trip_type" name="trip_type" placeholder="" value="<?php echo $trip_type ?>" disabled>
                    <input type="hidden" class="form-control" id="trip_type" name="trip_type" placeholder="" value="<?php echo $trip_type ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="trip_date" class="col-sm-2 control-label">Trip Date</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="trip_date" name="trip_date" placeholder="Trip Date" value="<?php echo $trip_date ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_id" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="vessel_id" name="vessel_id" onchange="populate('vessel_id',<?php echo $trip_id ?>)" required>
                        <?php
                            $query = "SELECT * FROM vessel";
                            $result = mysql_query($query);
                            echo "<option value=\"\"></option>";
                            while($row = mysql_fetch_array($result)){
                                if($row['vessel_id']==$vessel_id){
                                    $selected = "selected";
                                }
                                echo "<option value=".$row['vessel_id']." ".$selected.">".$row['vessel_code']."</option>";
                                $selected = "";
                            }
                        ?>
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
                <label for="trip_crew" class="col-sm-2 control-label">Trip Crews' ID <br> (separated by ',')</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="trip_crew" name="trip_crew" placeholder="" value="<?php echo $trip_crew ?>">
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




