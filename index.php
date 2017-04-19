<!DOCTYPE html>

<html>
	<head>
		<title>PDOFMS</title>
		<link rel="shortcut icon" href="images/fish.ico">
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	</head>
	<body>

		<br><br><br><br><br><br><br><br>

		<table class="table table1">
			<tr>
				<td width="10%">
				<td width="50%">
					<br><br>
					<b>Port Dickson Online Fisheries Management System (PDOFMS)</b>
					<br>
					<p align="justify">
						PDOFMS is a management support system specially built for Port Dickson's fisheries cooperative in order to assist fellow fishermen
						to increase their management efficiency.
					</p>
					<br>Please login to continue...
				</td>	
				<td width="10%">
				<td width="30%">
					<form class="form-signin" method="post" action="./connection/check_login.php">
					<h4 class="form-signin-heading" align="left"><font face="Trebuchet MS" ></font></h4>
						<?php
							if(isset($_GET["error"])){
								$error=$_GET["error"];
								if($error=1){
									$msg = "Wrong username or password.";
								}
							}
							if(isset($msg)){
								echo "<img src=".'./images/alert.png'." style=".'width:16px;height:16px'."> $msg<br><br>";
							}
						?>
					<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
					<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					</form>
				</td>
			</tr>
		</table>


	</body>

	<footer>
		<p align="center">&copy 2015 Port Dickson Online Fisheries Management System
	</footer>
</html>