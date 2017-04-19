<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Purchase</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM purchase where purchase_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $trip_id = $row['trip_id'];
            $fish_pd_code = $row['fish_pd_code'];
            $purchase_kg = $row['purchase_kg'];
            $user_id = $row['user_id'];

            $query_fish = "SELECT * FROM parameter_detail WHERE pd_head='fish' AND pd_code='$fish_pd_code'";
            $result_fish = mysql_query($query_fish);
            $row_fish = mysql_fetch_assoc($result_fish);

            $query_user = "SELECT * FROM user WHERE user_id = '$user_id'";
            $result_user = mysql_query($query_user);
            $row_user = mysql_fetch_assoc($result_user);

            $fish_name = $row_fish['pd_detail'];
            $user_name = $row_user['user_fullname'];

            $sql_catch = "SELECT * FROM catch WHERE trip_id='$trip_id' AND fish_pd_code='$fish_pd_code'";
            $result_catch = mysql_query($sql_catch);
            $row_catch = mysql_fetch_assoc($result_catch);

            $sql_balance = "SELECT sum(purchase_kg) AS sum FROM purchase WHERE trip_id = '$trip_id' AND fish_pd_code='$fish_pd_code'";
            $result_balance = mysql_query($sql_balance);
            $row_balance = mysql_fetch_assoc($result_balance);

            $balance_catch = $row_catch['catch_kg']-$row_balance['sum']+$purchase_kg;

        ?>

        <form class="form-horizontal" action="main.php?page=purchase_edit_submit&id=<?php echo $id ?>" method="post">

            <div class="form-group">
                <label for="trip_id" class="col-sm-2 control-label">Trip ID</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="trip_id" name="trip_id" value="<?php echo $trip_id ?>" placeholder="Fish Name" disabled>
                    <input type="hidden" class="form-control" id="trip_id" name="trip_id" value="<?php echo $trip_id ?>" placeholder="Fish Name" >
                </div>
            </div>

            <div class="form-group">
                <label for="fish_pd_code" class="col-sm-2 control-label">Fish Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="fish_pd_code_display" name="fish_pd_code_display" value="<?php echo $fish_name ?>" placeholder="Fish Name" disabled>
                    <input type="hidden" class="form-control" id="fish_pd_code" name="fish_pd_code" value="<?php echo $fish_pd_code ?>" placeholder="Fish Name" >
                </div>
            </div>

            <div class="form-group">
                <label for="purchase_kg" class="col-sm-2 control-label">Total Purchase (kg)</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="purchase_kg" pattern="[0-9]+([\.|,][0-9]+)?" min="0" max="<?php echo $balance_catch ?>" name="purchase_kg" value="<?php echo $purchase_kg ?>"  placeholder="Fish Price / kg">
                </div>
            </div>

            <div class="form-group">
                <label for="user_id" class="col-sm-2 control-label">Customer</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_id_display" name="user_id_display" value="<?php echo $user_name ?>" placeholder="Fish Name" disabled>
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id ?>" placeholder="Fish Name" >
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




