<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        var today = new Date();
        document.getElementById('time').innerHTML=today;

        function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
}
    </script>

    <a class="btn btn-primary btn-sm" onclick="printDiv('printable')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
    <a class="btn btn-primary btn-sm" href="main.php?page=payroll_view">Back</a>
    <br><br>

</head>

<body>

    <?php
        require('./connection/connect.php');

        $payroll_id = $_GET['id'];

        $query_payroll = "SELECT * FROM payroll WHERE payroll_id='$payroll_id'";
        $result_payroll = mysql_query($query_payroll);
        $row_payroll = mysql_fetch_assoc($result_payroll);

        $query_trip = "SELECT * FROM trip WHERE trip_id=$row_payroll[trip_id]";
        $result_trip = mysql_query($query_trip);
        $row_trip = mysql_fetch_assoc($result_trip);

        $query_vessel = "SELECT * FROM vessel WHERE vessel_id='$row_trip[vessel_id]'";
        $result_vessel = mysql_query($query_vessel);
        $row_vessel = mysql_fetch_assoc($result_vessel);

        $query_crew = "SELECT * FROM crew WHERE crew_id='$row_payroll[crew_id]'";
        $result_crew = mysql_query($query_crew);
        $row_crew = mysql_fetch_assoc($result_crew);

        $query_date = "SELECT CURDATE() as date";
        $result_date = mysql_query($query_date);
        $row_date = mysql_fetch_assoc($result_date);
    ?>

    <div id="printable">

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">Payslip for trip on <?php echo $row_trip['trip_date']." (".$row_vessel['vessel_code'].")" ?></h3>
        </div>

        <div class="panel-body">
            
            <table class="table">

                <tr>
                    <td width="200"><b>Name of Employer</b>
                    <td width="50">:
                    <td>PORT DICKSON FISHERIES COOP
                </tr>

                <tr>
                    <td width="200"><b>Name of Employee</b>
                    <td width="50">:
                    <td><?php echo $row_crew['crew_name'] ?>
                </tr>

                <tr>
                    <td width="200"><b>Payroll Generated Date</b>
                    <td width="50">:
                    <td><?php echo $row_payroll['payroll_date']?>
                </tr>

                <tr>
                    <td width="200"><b>Payslip Printed On</b>
                    <td width="50">:
                    <td><?php echo $row_date['date'] ?>
                </tr>

                <tr>
                    <td width="200"><b>Mode of Payment</b>
                    <td width="50">:
                    <td>Cash
                </tr>

                <tr>
                    <td width="200"><b>Total Pay</b>
                    <td width="50">:
                    <td>RM <?php echo $row_payroll['payroll_rm']?>
                </tr>

            </table>

        </div>
    </div>

    </div>

</body>

</html>




