<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add new Catch</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=catch_insert" method="post">

            <div class="form-group">
                <label for="trip_id" class="col-sm-2 control-label">Trip ID</label>
                <div class="col-sm-5">
                    <select class="form-control" id="trip_id" name="trip_id" required>
                        <?php
                            require('./connection/connect.php');

                            $query = "SELECT * FROM trip";
                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){
                                $value = $row['trip_id'];
                                echo "<option value=".$value.">".$value."</option>";
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
                                $value = $row['pd_code'];
                                echo "<option value=\"".$value."\">".$row['pd_detail']."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="catch_kg" class="col-sm-2 control-label">Catch (kg)</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="catch_kg" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" name="catch_kg" required>
                </div>
            </div>

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




