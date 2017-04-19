<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Path</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM path where path_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $path_id = $row['path_id'];
            $path_code = $row['path_code'];
            $vessel_id = $row['vessel_id'];

        ?>

        <form class="form-horizontal" action="main.php?page=path_edit_submit&id= <?php echo $path_id ?> " method="post">

            <div class="form-group">
                <label for="path_code" class="col-sm-2 control-label">Path Code</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="path_code" name="path_code" value="<?php echo $path_code ?>" placeholder="Path Code" disabled>
                    <input type="hidden" class="form-control" id="path_code" name="path_code" value="<?php echo $path_code ?>" placeholder="Path Code" >
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_id" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="vessel_id" name="vessel_id" required>
                        <?php

                            $query = "SELECT * FROM vessel";
                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){

                                $query_path = "SELECT count(*) AS count FROM path WHERE vessel_id = '$row[vessel_id]'";
                                $result_path = mysql_query($query_path);
                                $row_path = mysql_fetch_assoc($result_path);

                                $display = " (".$row_path['count']." path(s) assigned)";

                                $selected = "";
                                if($row['vessel_id']==$vessel_id){
                                    $selected = " selected";
                                }

                                echo "<option value=".$row['vessel_id'].$selected.">".$row['vessel_code'].$display."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="btn btn-primary btn-sm" href="main.php?page=path_view">Cancel</a>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




