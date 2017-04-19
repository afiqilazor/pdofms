<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add new Fish Price</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=fish_insert" method="post">

            <div class="form-group">
                <label for="fish_pd_code" class="col-sm-2 control-label">Fish Name</label>
                <div class="col-sm-5">

                    <select class="form-control" id="fish_pd_code" name="fish_pd_code" required>
                        <?php
                            require('./connection/connect.php');

                            $query = "SELECT * FROM parameter_detail where pd_head='fish'";

                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){
                                $value = $row['pd_code'];
                                $display = $row['pd_detail'];
                                echo "<option value=".$value.">".$display."</option>";
                            }
                        ?>
                    </select>

                </div>
            </div>

            <div class="form-group">
                <label for="fish_price" class="col-sm-2 control-label">Price (RM) / kg</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="fish_price" name="fish_price" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" placeholder="Fish Price / kg" required>
                </div>
            </div>

            <div class="form-group">
                <label for="fish_pd_code" class="col-sm-2 control-label">Customer Name</label>
                <div class="col-sm-5">

                    <select class="form-control" id="user_id" name="user_id" required>
                        <?php

                            $query = "SELECT * FROM user where user_pd_value='3'";

                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){
                                $value = $row['user_id'];
                                $display = $row['user_fullname'];
                                echo "<option value=".$value.">".$display."</option>";
                            }
                        ?>
                    </select>

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




