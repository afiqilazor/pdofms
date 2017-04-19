<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit User</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM user where user_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $user_name = $row['user_name'];
            $user_fullname = $row['user_fullname'];
            $user_ic = $row['user_ic'];
            $user_pd_value = $row['user_pd_value'];

        ?>

        <form class="form-horizontal" action="main.php?page=user_edit_submit&id= <?php echo $id ?> " method="post">

            <div class="form-group">
                <label for="user_name" class="col-sm-2 control-label">User Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" value="<?php echo $user_name ?>" disabled>
                    <input type="hidden" class="form-control" id="user_name" name="user_name" placeholder="User Name" value="<?php echo $user_name ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_fullname" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Name as in NRIC" value="<?php echo $user_fullname ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_ic" class="col-sm-2 control-label">NRIC</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control" id="user_ic" name="user_ic"  maxlength="12" placeholder="xxxxxxxxxxxx" value="<?php echo $user_ic ?>" disabled>
                    <input type="hidden" class="form-control" id="user_ic" name="user_ic"  maxlength="12" placeholder="xxxxxxxxxxxx" value="<?php echo $user_ic ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_pd_value" class="col-sm-2 control-label">User Level</label>
                <div class="col-sm-5">
                    <select class="form-control" id="user_pd_value" name="user_pd_value" required>
                        <?php
                            if($user_pd_value=="1"){
                                $superselected = "selected";
                            } else if ($user_pd_value=="3"){
                                $customerselected = "selected";
                            }

                            echo "<option value=\"1\" ".$adminselected.">Administrator</option>";
                            echo "<option value=\"3\" ".$customerselected.">Customer</option>";

                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="btn btn-primary btn-sm" href="main.php?page=user_view">Cancel</a>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




