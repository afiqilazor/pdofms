<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/general2.css" rel="stylesheet">
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

    <div id="printable">
        <link href="css/general2.css" rel="stylesheet">

        <div class="panel panel-default">

            <?php
                require('./connection/connect.php');
                $year = $_POST['year'];
            ?>

            <div class="panel-heading">
                <h3 class="panel-title">Payroll Yearly Report (<?php echo $year ?>)</h3>
            </div>

            <div class="table table-striped">

            <?php

                $query_crew = "SELECT * FROM crew WHERE crew_id != '1' ORDER BY crew_name ASC";
                $result_crew = mysql_query($query_crew);

                echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

                echo 
                "<thead>
                    <tr>
                        <th class=text-center>No.</th>
                        <th class=text-left>Crew Name</th>
                        <th class=text-right>JAN</th>
                        <th class=text-right>FEB</th>
                        <th class=text-right>MAR</th>
                        <th class=text-right>APR</th>
                        <th class=text-right>MAY</th>
                        <th class=text-right>JUN</th>
                        <th class=text-right>JUL</th>
                        <th class=text-right>AUG</th>
                        <th class=text-right>SEP</th>
                        <th class=text-right>OCT</th>
                        <th class=text-right>NOV</th>
                        <th class=text-right>DEC</th>
                        <th class=text-right><b>TOTAL (RM)</b></th>
                    </tr>

                </thead><tbody>";

                $count = 1;

                $grandTotal = array(0,0,0,0,0,0,0,0,0,0,0,0);
                $grandTotal2 = 0;

                while ($row = mysql_fetch_array($result_crew)) {

                    echo 
                      "<tr>"
                    . "<td align=middle>"       . $count++
                    . "</td><td align=left>"    . $row['crew_name'];

                    $total = 0;

                    for ($month=1; $month < 13; $month++) {

                        $query_ms = "select sum(payroll_rm) as sum from payroll where crew_id=".$row['crew_id']." and month(payroll_date) =".$month;
                        $result_ms = mysql_query($query_ms);
                        $row_ms = mysql_fetch_assoc($result_ms);

                        $content = $row_ms['sum'] == 0 ? "-" : $row_ms['sum'];
                        $total += $content;
                        $grandTotal[$month-1] += $content;

                        echo "<td align=right>" . $content . "</td>";

                    }

                    echo "<td align=right><b>" . $total . "</b></td>";

                    $grandTotal2 += $total;

                    echo "</td></tr>";
                }

                echo "<tr>";
                echo "<td>";
                echo "<td align=right><b>TOTAL (RM)</b>";

                for ($month=1; $month < 13; $month++) { 
                    echo "<td align=right><b>".$grandTotal[$month-1]."</b>";
                }
                echo "<td align=right><b>".$grandTotal2."</b>";

                echo "</tr>";

                echo "</tbody></table>";
            ?>
        </div>

    </div>

    </div>

</body>

</html>




