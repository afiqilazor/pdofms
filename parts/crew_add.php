<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add new Crew</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=crew_insert" method="post">

            <div class="form-group">
                <label for="crew_name" class="col-sm-2 control-label">Crew Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="crew_name" name="crew_name" placeholder="Crew Name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="crew_ic_no" class="col-sm-2 control-label">Crew IC No.</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="crew_ic_no" name="crew_ic_no" pattern="[0-9]{12}" placeholder="Crew IC No." maxlength="12" required>
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_id" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="vessel_id" name="vessel_id" required>
                        <?php
                            require('./connection/connect.php');

                            $query_vessel = "SELECT * FROM vessel";
                            $result_vessel = mysql_query($query_vessel);
                            while($row_vessel = mysql_fetch_array($result_vessel)){

                                $query_crew = "SELECT count(*) AS count FROM crew WHERE vessel_id='$row_vessel[vessel_id]'";
                                $result_crew = mysql_query($query_crew);
                                $row_crew = mysql_fetch_assoc($result_crew);

                                if($row_crew['count']<$row_vessel['vessel_max_capacity']){
                                    $value = $row_vessel['vessel_id'];
                                    $display1 = $row_vessel['vessel_code'];
                                    $display = " (".$row_crew['count']."/".$row_vessel['vessel_max_capacity'].")";
                                }

                                echo "<option value=".$value.">".$display1.$display."</option>";

                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="crew_is_captain" class="col-sm-2 control-label">Crew Position</label>
                <div class="col-sm-5">
                    <select class="form-control" id="crew_is_captain" name="crew_is_captain" required>
                        <option value="0">CREW</option>
                        <option value="1">CAPTAIN</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="crew_partition" class="col-sm-2 control-label">Crew Partition</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="crew_partition" name="crew_partition" placeholder="Crew Partition" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    <a class="btn btn-primary btn-sm" href="main.php?page=crew_view">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
    
</body>

</html>




