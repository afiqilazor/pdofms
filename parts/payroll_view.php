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

    <form class="form-horizontal" action="main.php?page=report_view" method="post">

        <table>
            <tr>
                <td><a class="btn btn-primary btn-sm" href="main.php?page=payroll_add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Generate Payroll</a>
                <td width="75%"><td>
                    <select class="form-control" id="year" name="year" required>
                        <?php
                            require("./connection/connect.php");

                            $query_year = "select distinct year(payroll_date) as year from payroll ORDER BY year DESC";
                            $result_year = mysql_query($query_year);

                            while($row_year = mysql_fetch_array($result_year)){
                                echo "<option value=\"".$row_year['year']."\">".$row_year['year']."</option>";
                            }

                        ?>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Yearly Report</button>
                </td>
            </tr>
        </table>
        
    </form>

    <br><br>

    <div class="table table-striped">

        <?php
            require('./connection/connect.php');

            $query = "SELECT * FROM payroll";
            $result = mysql_query($query);

            echo "<table align=\"center\" id=\"table1\" class=\"table table-condensed table-hover table-curved display\">";

            echo 
            "<thead>
                <tr>
                    <th class=text-center>ID.</th>
                    <th class=text-left>Crew Name</th>
                    <th class=text-center>Trip ID</th>
                    <th class=text-center>Payroll Date</th>
                    <th class=text-right>Total (RM)</th>
                    <th class=text-right></th>
                </tr>

            </thead><tbody>";

            $count = 1;
            $sure = "'Are you sure?'";

            while ($row = mysql_fetch_array($result)) {

                $query_crew = "SELECT * FROM crew WHERE crew_id = $row[crew_id]";
                $result_crew = mysql_query($query_crew);
                $row_crew = mysql_fetch_assoc($result_crew);

                echo 
                  "<tr>"
                . "<td align=middle>"       . $row['payroll_id']
                . "<td align=left>"       . $row_crew['crew_name']
                . "<td align=middle>"       . $row['trip_id']
                . "<td align=middle>"       . $row['payroll_date']
                . "</td><td align=right>"    . $row['payroll_rm'] 
                . "</td><td align=right> "  . '<a class="btn btn-primary btn-xs" href="main.php?page=payroll_print&id='.$row['payroll_id'].'"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>  Print</a>' 
                //. " "                       . '<a class="btn btn-primary btn-xs" href="main.php?page=vessel_delete&id='.$row['vessel_id'].'" onclick="return confirm('.$sure.')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
                . "</td></tr>";

            }

            echo "</tbody></table>";
        ?>

    </div>
</body>

</html>




