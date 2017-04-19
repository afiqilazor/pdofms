<?php require('./connection/connect.php'); ?>

<!doctype html>
<html>
<head>
<title>Bar Chart</title>
</head>
<body>

<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading text-center">Monthly Catch (kg)</div>
<div class="panel-body">
<div style="width: 100%">
<canvas id="canvas" height="250" width="250"></canvas>
</div>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading text-center">Monthly Revenue (RM)</div>
<div class="panel-body">
<div style="width: 100%">
<canvas id="canvas2" height="250" width="250"></canvas>
</div>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading text-center">Vessel with lowest activites</div>
<div class="panel-body">
<table class="table table-bordered">

<?php

$query_perf = "SELECT vessel_id, count(*) as test from trip group by vessel_id order by test asc";
$result_perf = mysql_query($query_perf);

$query_count_trip = "SELECT count(*) as count FROM trip";
$result_count_trip = mysql_query($query_count_trip);
$row_count_trip = mysql_fetch_assoc($result_count_trip);

$count = 0;
while($row_perf = mysql_fetch_array($result_perf)){
if($count<2){
$query_vessel = "SELECT * FROM vessel WHERE vessel_id='$row_perf[vessel_id]'";
$result_vessel = mysql_query($query_vessel);
$row_vessel = mysql_fetch_assoc($result_vessel);

$value = round($row_perf['test']/$row_count_trip['count']*100,2);

echo "<tr>
<td width=\"70\">".$row_vessel['vessel_code']."
<td>
<div class=\"progress\">
<div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"".$value."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$value."%;\">
".$value."%</div>
</div>
</td>
</tr>";
$count++;
}
}

?>

</table>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading text-center">Path with lowest catch</div>
<div class="panel-body">
<table class="table table-bordered">

<?php

$query_total = "SELECT c.path_id, sum(catch_kg) as sum FROM catch a
INNER JOIN trip b ON a.trip_id = b.trip_id
INNER JOIN path c ON b.path_id = c.path_id
group by c.path_id
order by sum desc";
$result_total = mysql_query($query_total);

$query_total_catch = "SELECT sum(catch_kg) as sum FROM catch";
$result_total_catch = mysql_query($query_total_catch);
$row_total_catch = mysql_fetch_assoc($result_total_catch);

$count = 0;
while($row_total = mysql_fetch_array($result_total)){
if($count<2){
$query_path = "SELECT * FROM path WHERE path_id='$row_total[path_id]'";
$result_path = mysql_query($query_path);
$row_path = mysql_fetch_assoc($result_path);

$value = round($row_total['sum']/$row_total_catch['sum']*100, 2);

echo "<tr>
<td width=\"70\">".$row_path['path_code']."
<td>
<div class=\"progress\">
<div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"".$value."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$value."%;\">
".$value."%</div>
</div>
</td>
</tr>";
$count++;
}
}

?>

</table>
</div>
</div>
</div>



<script>

var barChartData = {
labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
datasets : [
{
fillColor : "rgba(7, 62, 131, 1)",
strokeColor : "rgba(220,220,220,0.8)",
highlightFill: "rgba(0, 0, 255, 1)",
highlightStroke: "rgba(220,220,220,1)",

<?php
$catch_data = array();

for ($i=0; $i < 13; $i++) { 

$query_catch = "SELECT sum(catch_kg) as total_catch FROM catch WHERE trip_id in (SELECT trip_id FROM trip WHERE MONTH(trip_date) = '$i' AND YEAR(trip_date)=YEAR(CURDATE()))";
$result_catch = mysql_query($query_catch);
$row_catch = mysql_fetch_assoc($result_catch);

$catch_data[$i] = $row_catch['total_catch'] == null? 0 : $row_catch['total_catch'];

}
echo "data : [".$catch_data[1].",".$catch_data[2].",".$catch_data[3].",".$catch_data[4].",".$catch_data[5].","
.$catch_data[6].",".$catch_data[7].",".$catch_data[8].",".$catch_data[9].",".$catch_data[10].","
.$catch_data[11].",".$catch_data[12]
."]"
?>

}
]
}

var lineChartData = {
labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
datasets : [
{
label: "My First dataset",
fillColor : "rgba(220,220,220,0.2)",
strokeColor : "rgba(220,220,220,1)",
pointColor : "rgba(220,220,220,1)",
pointStrokeColor : "#fff",
pointHighlightFill : "#fff",
pointHighlightStroke : "rgba(220,220,220,1)",

<?php
$total_data = array();

for ($i=0; $i < 13; $i++) { 

$query_income = "SELECT sum(payroll_rm) as sum FROM payroll WHERE trip_id in (SELECT trip_id FROM trip WHERE MONTH(trip_date) = '$i' AND YEAR(trip_date)=YEAR(CURDATE())) AND crew_id = '1'";
$result_income = mysql_query($query_income);
$row_income = mysql_fetch_assoc($result_income);

$total_data[$i] = $row_income['sum'] == null? 0 : $row_income['sum'];

}
echo "data : [".$total_data[1].",".$total_data[2].",".$total_data[3].",".$total_data[4].",".$total_data[5].","
.$total_data[6].",".$total_data[7].",".$total_data[8].",".$total_data[9].",".$total_data[10].","
.$total_data[11].",".$total_data[12]
."]"
?>
}
]

}

window.onload = function(){
var ctx = document.getElementById("canvas").getContext("2d");
window.myBar = new Chart(ctx).Bar(barChartData, {
responsive : true
});

var ctx = document.getElementById("canvas2").getContext("2d");
window.myLine = new Chart(ctx).Line(lineChartData, {
responsive: true
});
}

</script>
</body>
</html>
