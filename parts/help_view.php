<!DOCTYPE html>
<html lang="en">

<head>
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table1').dataTable();
        });
</script>
</head>

<body>

    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">General Information</h3></div>
        <div class="panel-body">

            <h5><b>System Parameter
            <h6><ul>
                <li>System parameters (highlighted) are global configuration used for calculations and references () in the system.
            </ul>

            <h5><b>Fish Price
            <h6><ul>
                <li>Pricing are use at purchasing.
                <li>Each customer has their own fish price.
                <li>The current price will be captured upon initating purchase.
                <li>Confirm price before initiating purchase.
            </ul>

            <h5><b>Path
            <h6><ul>
                <li>Path is a collection of trap locations plotted via GPS.
                <li>As PDOFMS has not integrated GPS functionality, users need to refer to external tool/map to determine path.
                <br><br><img src="./images/route.jpg" style="width:304px;height:100px;">
            </ul>

            <h5><b>Payroll
            <h6><ul>
                <li>Payroll is generated through Trip ID.
                <li>If there are changes made to trip, catch, or purchase for a trip, payroll can be generated again. Doing this will
                    update existing generated payrolls.
                <li>Payroll Calculation
                    <br><br>
                    <img src="./images/payroll.jpg" style="width:304px;height:100px;">
            </ul>

        </div>
    </div>




</body>

</html>




