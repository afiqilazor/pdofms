<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">User Profile</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM user where user_name='$_SESSION[user_name]'";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];

        ?>

        <form class="form-horizontal" action="main.php?page=profile_edit_submit&id= <?php echo $user_id ?> " method="post">

            <div class="form-group">
                <label for="user_name" class="col-sm-2 control-label">User Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user_name ?>" placeholder="User Name" >
                </div>
            </div>

            <div class="form-group">
                <label for="user_password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_password" name="user_password" value="<?php echo $user_password ?>"  placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </div>
        </form>

      </div>
    </div>
    
</body>

</html>




