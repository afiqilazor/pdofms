<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Fish Price</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM vessel where vessel_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $vessel_id = $row['vessel_id'];
            $vessel_code = $row['vessel_code'];
            $vessel_max_capacity = $row['vessel_max_capacity'];

        ?>

        <form class="form-horizontal" action="main.php?page=vessel_edit_submit&id= <?php echo $vessel_id ?> " method="post">

            <div class="form-group">
                <label for="vessel_code" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="vessel_code" name="vessel_code" value="<?php echo $vessel_code ?>" placeholder="Vessel Code" disabled>
                    <input type="hidden" class="form-control" id="vessel_code" name="vessel_code" value="<?php echo $vessel_code ?>" placeholder="Vessel Code">
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_max_capacity" class="col-sm-2 control-label">Maximum Capacity</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="vessel_max_capacity" name="vessel_max_capacity" value="<?php echo $vessel_max_capacity ?>" placeholder="Maximum Capacity">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="btn btn-primary btn-sm" href="main.php?page=vessel_view">Cancel</a>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




