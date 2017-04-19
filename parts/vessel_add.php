<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add new Vessel</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=vessel_insert" method="post">

            <div class="form-group">
                <label for="vessel_code" class="col-sm-2 control-label">Vessel Registration Number</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="vessel_code" name="vessel_code" placeholder="Vessel Code" required>
                </div>
            </div>

            <div class="form-group">
                <label for="vessel_max_capacity" class="col-sm-2 control-label">Maximum Capacity</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="vessel_max_capacity" name="vessel_max_capacity" placeholder="Maximum Capacity" required>
                </div>
            </div>

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




