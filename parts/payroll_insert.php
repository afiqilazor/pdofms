<?php

	require('./connection/connect.php');

	$trip_id = $_POST['trip_id'];

	$query = "SELECT * FROM trip WHERE trip_id = $trip_id";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

	if($row['trip_id'] == null){

		echo "<script>alert('Trip does not exist.'); location.href='main.php?page=payroll_add';</script>";		

	} else {

		if($row['trip_type'] == '2'){ // for renew trips

			$query_parameter = "SELECT * FROM parameter_detail WHERE pd_head='trip'";
			$result_parameter = mysql_query($query_parameter);

			$totalSupply = "";
			while($row_parameter = mysql_fetch_array($result_parameter)){
				if($row_parameter['pd_code']=='trap_fuel_rm'){
					$totalSupply += $row_parameter['pd_value_digit'];
				} else if ($row_parameter['pd_code'] == 'supply_crew_rm'){
					$totalSupply += $row_parameter['pd_value_digit'];
				}
			}
			$totalSupply = $totalSupply*-1;

			$query_checkExistingPayroll = "SELECT count(*) as count FROM payroll WHERE trip_id='$trip_id' AND crew_id='1'";
			$result_checkExistingPayroll = mysql_query($query_checkExistingPayroll);
			$row_checkExistingPayroll = mysql_fetch_assoc($result_checkExistingPayroll);

			if($row_checkExistingPayroll['count']>0){

				$query_update = "UPDATE payroll SET 
					payroll_date=curdate(),
					payroll_rm='$totalSupply'
				where trip_id='$trip_id' and crew_id='1'";

				mysql_query($query_update);

			} else if($row_checkExistingPayroll['count']==0){

				$query_insert = "INSERT INTO payroll(
					trip_id,
					crew_id,
					payroll_date,
					payroll_rm
				) VALUES (
					'$trip_id',
					'1',
					curdate(),
					'$totalSupply'
				)";

				mysql_query($query_insert);
			}

			echo "<script>alert('Payroll processed.'); location.href='main.php?page=payroll_view';</script>";

		} else { //for normal trips
			
			$query_purchase = "SELECT * FROM purchase WHERE trip_id=$trip_id";
			$result_purchase = mysql_query($query_purchase);

			$totalPurchase = 0;
			while($row_purchase = mysql_fetch_array($result_purchase)){
				$totalPurchase += $row_purchase['purchase_price_rm']*$row_purchase['purchase_kg'];
			}

			$dontnotification = '0';
			if($row['trip_crew']==""){
				$dontnotification = '1';
				echo "<script>alert('Please assign crew to trip.'); location.href='main.php?page=payroll_add';</script>";
			}

			$crewIdArray = explode(',', $row['trip_crew']);
			array_push($crewIdArray, '1');
			$totalPartition = 0;
			foreach ($crewIdArray as $id) {
				
				$query_total_partition = "SELECT * FROM crew WHERE crew_id = '$id'";
				$result_total_partition = mysql_query($query_total_partition);
				$row_total_partition = mysql_fetch_assoc($result_total_partition);
				$totalPartition += $row_total_partition['crew_partition'];

			}

			$query_parameter = "SELECT * FROM parameter_detail WHERE pd_head='trip'";
			$result_parameter = mysql_query($query_parameter);

			$totalSupply = "";
			while($row_parameter = mysql_fetch_array($result_parameter)){
				if($row_parameter['pd_code']=='catch_fuel_rm'){
					$totalSupply += $row_parameter['pd_value_digit'];
				} else if ($row_parameter['pd_code'] == 'supply_crew_rm'){
					$totalSupply += $row_parameter['pd_value_digit'];
				}
			}

			$totalPurchase = $totalPurchase-$totalSupply;
			$cashPerPartition = $totalPartition == 0 ? 0 : $totalPurchase/$totalPartition;

			foreach($crewIdArray as $id){

				$query_checkExistingPayroll = "SELECT count(*) as count FROM payroll WHERE trip_id='$trip_id' AND crew_id='$id'";
				$result_checkExistingPayroll = mysql_query($query_checkExistingPayroll);
				$row_checkExistingPayroll = mysql_fetch_assoc($result_checkExistingPayroll);

				$query_crew = "SELECT * FROM crew WHERE crew_id='$id'";
				$result_crew = mysql_query($query_crew);
				$row_crew = mysql_fetch_assoc($result_crew);

				$total_pay = $cashPerPartition*$row_crew['crew_partition'];

				if($total_pay>0 && $row_checkExistingPayroll['count']>0){

					$query_update = "UPDATE payroll SET 
						payroll_date=curdate(),
						payroll_rm='$total_pay'
					where trip_id='$trip_id' and crew_id='$id'";

					mysql_query($query_update);

				} else if($total_pay>0 && $row_checkExistingPayroll['count']==0){
					$query_insert = "INSERT INTO payroll(
						trip_id,
						crew_id,
						payroll_date,
						payroll_rm
					) VALUES (
						'$trip_id',
						'$id',
						curdate(),
						'$total_pay'
					)";

					mysql_query($query_insert);
				}
			}

			if($dontnotification != '1'){
				echo "<script>alert('Payroll processed.'); location.href='main.php?page=payroll_view';</script>";
			}
		}

		
	}


?>