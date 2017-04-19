<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Fish Parameter</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=parameter_insert" method="post">

            <div class="form-group">
                <label for="pd_detail" class="col-sm-2 control-label">Fish Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pd_detail" name="pd_detail" placeholder="Fish Name" required>
                </div>
            </div>

                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    <a class="btn btn-primary btn-sm" href="main.php?page=parameter_view">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
    
</body>

</html>




