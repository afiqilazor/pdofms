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

            $query = "SELECT * FROM fish where fish_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $fish_id = $row['fish_id'];
            $fish_pd_code = $row['fish_pd_code'];
            $fish_price = $row['fish_price'];
            $user_id = $row['user_id'];

            $query_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$fish_pd_code'";
            $result_fish = mysql_query($query_fish);
            $row_fish = mysql_fetch_assoc($result_fish);

            $query_user = "SELECT * FROM user WHERE user_id = '$user_id'";
            $result_user = mysql_query($query_user);
            $row_user = mysql_fetch_assoc($result_user);

            $fish_display = $row_fish['pd_detail'];
            $user_display = $row_user['user_fullname'];

        ?>

        <form class="form-horizontal" action="main.php?page=fish_edit_submit&id= <?php echo $fish_id ?> " method="post">

            <div class="form-group">
                <label for="fish_code" class="col-sm-2 control-label">Fish Code</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="fish_pd_code" name="fish_pd_code" value="<?php echo $fish_display ?>" placeholder="Fish Name" disabled>
                    <input type="hidden" class="form-control" id="fish_pd_code" name="fish_pd_code" value="<?php echo $fish_display ?>" placeholder="Fish Name" >
                </div>
            </div>

            <div class="form-group">
                <label for="fish_price" class="col-sm-2 control-label">Current Price (RM) / kg</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="fish_price" pattern="[0-9]+([\.|,][0-9]+)?" name="fish_price" value="<?php echo $fish_price ?>"  placeholder="Fish Price / kg">
                </div>
            </div>

            <div class="form-group">
                <label for="fish_code" class="col-sm-2 control-label">Customer Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_display ?>" placeholder="Customer Name" disabled>
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id ?>" placeholder="Customer Name" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="btn btn-primary btn-sm" href="main.php?page=fish_view">Cancel</a>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




