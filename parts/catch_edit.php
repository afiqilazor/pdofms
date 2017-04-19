<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Catch</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM catch where catch_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $catch_id = $row['catch_id'];
            $trip_id = $row['trip_id'];
            $fish_pd_code = $row['fish_pd_code'];
            $catch_kg = $row['catch_kg'];

        ?>

        <form class="form-horizontal" action="main.php?page=catch_edit_submit&id= <?php echo $catch_id ?> " method="post">

            <div class="form-group">
                <label for="trip_id" class="col-sm-2 control-label">Trip ID</label>
                <div class="col-sm-5">
                    <select class="form-control" id="trip_id" name="trip_id" required>
                        <?php

                            $query = "SELECT * FROM trip";
                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){
                                $selected = "";
                                if($row['trip_id']==$trip_id){
                                    $selected = "selected";
                                }
                                $value = $row['trip_id'];
                                echo "<option value=\"".$value."\" ".$selected.">".$value."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="fish_pd_code" class="col-sm-2 control-label">Fish Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="fish_pd_code" name="fish_pd_code" required>
                        <?php

                            $query = "SELECT * FROM parameter_detail WHERE pd_head='fish'";
                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){
                                $selected = "";
                                if($row['pd_code']==$fish_pd_code){
                                    $selected = "selected";
                                }
                                $value = $row['pd_code'];
                                echo "<option value=\"".$value."\" ".$selected.">".$row['pd_detail']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="catch_kg" class="col-sm-2 control-label">Catch (kg)</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="catch_kg" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" name="catch_kg" value="<?php echo $catch_kg ?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="btn btn-primary btn-sm" href="main.php?page=catch_view">Cancel</a>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




