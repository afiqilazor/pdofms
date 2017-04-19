<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Path</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=path_insert" method="post">

            <div class="form-group">
                <label for="path_code" class="col-sm-2 control-label">Path Code</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="path_code" name="path_code" placeholder="Path Code" required>
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_id" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="vessel_id" name="vessel_id">
                        <?php
                            require('./connection/connect.php');

                            $query = "SELECT * FROM vessel";
                            $result = mysql_query($query);

                            while($row = mysql_fetch_array($result)){

                                $query_path = "SELECT count(*) AS count FROM path WHERE vessel_id = '$row[vessel_id]'";
                                $result_path = mysql_query($query_path);
                                $row_path = mysql_fetch_assoc($result_path);

                                $display = " (".$row_path['count']." path(s) assigned)";

                                echo "<option value=".$row['vessel_id'].">".$row['vessel_code'].$display."</option>";
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




