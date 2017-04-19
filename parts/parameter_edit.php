<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Parameter</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM parameter_detail where pd_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $pd_detail = $row['pd_detail'];
            $pd_head = $row['pd_head'];
            $digit = $row['pd_value_digit'];

            $hidden = "number";
            $disabled = "disabled";
            $disabled2 = "";

            if($pd_head == 'fish'){
                $hidden = "hidden";
                $disabled = "";
                $disabled2 = "disabled";
            }
        ?>

        <form class="form-horizontal" action="main.php?page=parameter_edit_submit&id= <?php echo $id ?> " method="post">

            <div class="form-group">
                <label for="pd_detail" class="col-sm-2 control-label">Detail</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pd_detail" name="pd_detail" value="<?php echo $pd_detail ?>" placeholder="" <?php echo $disabled ?>>
                    <input type="hidden" class="form-control" id="pd_detail" name="pd_detail" value="<?php echo $pd_detail ?>" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <?php
                    if($pd_head != 'fish'){
                        echo "<label for=\"pd_value_digit\" class=\"col-sm-2 control-label\">Value</label>";
                    }
                ?>
                <div class="col-sm-5">
                    <input type="<?php echo $hidden ?>" class="form-control" id="pd_value_digit" name="pd_value_digit" value="<?php echo $digit ?>" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="btn btn-primary btn-sm" href="main.php?page=parameter_view">Cancel</a>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




