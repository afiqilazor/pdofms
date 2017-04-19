<!DOCTYPE html>
<html lang="en">

<head></head>

<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Add new User</h3>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" action="main.php?page=user_insert" method="post">

            <div class="form-group">
                <label for="user_name" class="col-sm-2 control-label">User Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Used for login" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_fullname" class="col-sm-2 control-label">Full Name</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Name as in NRIC" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_ic" class="col-sm-2 control-label">NRIC</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control" id="user_ic" name="user_ic"  pattern="[0-9]{12}" maxlength="12" placeholder="************" required>
                </div>
            </div>

            <div class="form-group">
                <label for="user_pd_value" class="col-sm-2 control-label">User Level</label>
                <div class="col-sm-5">
                    <select class="form-control" id="user_pd_value" name="user_pd_value" required>
                        <option value=""></option>
                        <option value="1">Administrator</option>
                        <option value="3">Customer</option>
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




