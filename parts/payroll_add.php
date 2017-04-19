<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Generate Payroll</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=payroll_insert" method="post">

            <div class="form-group">
                <label for="trip_id" class="col-sm-2 control-label">Trip ID</label>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="trip_id" name="trip_id" required>
                </div>
            </div>

            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                <a class="btn btn-primary btn-sm" href="main.php?page=payroll_view">Cancel</a>
            </div>
            </div>
        </form>
    </div>
</div>
    
</body>

</html>




