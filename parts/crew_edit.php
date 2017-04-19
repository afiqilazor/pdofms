<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Crew</h3>
      </div>
      <div class="panel-body">

        <?php
            require('./connection/connect.php');

            $id = $_GET['id'];

            $query = "SELECT * FROM crew where crew_id=$id";
            $result = mysql_query($query);
            $row = mysql_fetch_assoc($result);

            $crew_id = $row['crew_id'];
            $crew_name = $row['crew_name'];
            $crew_ic_no = $row['crew_ic_no'];
            $vessel_id = $row['vessel_id'];
            $crew_is_captain = $row['crew_is_captain'];
            $crew_partition = $row['crew_partition'];

        ?>

        <form class="form-horizontal" action="main.php?page=crew_edit_submit&id= <?php echo $crew_id ?> " method="post">

            <div class="form-group">
                <label for="crew_name" class="col-sm-2 control-label">Crew Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="crew_name" name="crew_name" value="<?php echo $crew_name ?>" placeholder="Crew Name" >
                </div>
            </div>

            <div class="form-group">
                <label for="crew_ic_no" class="col-sm-2 control-label">Crew IC. No.</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="crew_ic_no" name="crew_ic_no" value="<?php echo $crew_ic_no ?>"  placeholder="Crew IC No." disabled>
                    <input type="hidden" class="form-control" id="crew_ic_no" name="crew_ic_no" value="<?php echo $crew_ic_no ?>"  placeholder="Crew IC No.">
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_id" class="col-sm-2 control-label">Vessel Code</label>
                <div class="col-sm-5">
                    <select class="form-control" id="vessel_id" name="vessel_id" required>
                        <?php

                            $query_vessel = "SELECT * FROM vessel";
                            $result_vessel = mysql_query($query_vessel);

                            while($row_vessel = mysql_fetch_array($result_vessel)){

                                $query_crew = "SELECT count(*) AS count FROM crew WHERE vessel_id=$row_vessel[vessel_id]";
                                $result_crew = mysql_query($query_crew);
                                $row_crew = mysql_fetch_assoc($result_crew);

                                if($row_crew['count']<$row_vessel['vessel_max_capacity'] || $row_vessel['vessel_id']==$vessel_id){

                                    $selected = "";

                                    if($row_vessel['vessel_id']==$vessel_id){
                                        $selected = " selected";
                                    }

                                    $value = $row_vessel['vessel_id'];
                                    $display1 = $row_vessel['vessel_code'];
                                    $display = " (".$row_crew['count']."/".$row_vessel['vessel_max_capacity'].")";
                                    echo "<option value=".$value."".$selected.">".$display1.$display."</option>";

                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="crew_is_captain" class="col-sm-2 control-label">Crew Position</label>
                <div class="col-sm-5">
                    <select class="form-control" id="crew_is_captain" name="crew_is_captain" required>
                        <?php

                            $query = "SELECT * FROM crew where crew_id=$crew_id";

                            $result = mysql_query($query);
                            $row = mysql_fetch_assoc($result);

                            $crewselected = "";
                            $captainselected = "";

                            if($row['crew_is_captain']=="1"){
                                $captainselected = "selected";
                            } else {
                                $crewselected = "selected";
                            }

                            echo "<option value=\"0\" ".$crewselected.">CREW</option>";
                            echo "<option value=\"1\" ".$captainselected.">CAPTAIN</option>";
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="crew_partition" class="col-sm-2 control-label">Crew Partition</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="crew_partition" name="crew_partition" placeholder="Crew Partition" value="<?php echo $crew_partition ?>" required>
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




