<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$vehicletitle = $_POST['vehicletitle'];
		$brand = $_POST['brandname'];
		$vehicleoverview = $_POST['vehicalorcview'];
		$price = $_POST['price'];
		$fueltype = $_POST['fueltype'];
		$engine = $_POST['engine'];
		$peaktorque = $_POST['peaktorque'];
		$peakpower = $_POST['peakpower'];
		$transmission = $_POST['transmission'];
		$modelyear = $_POST['modelyear'];
		$seatingcapacity = $_POST['seatingcapacity'];
		$vimage1 = $_FILES["img1"]["name"];
		$vimage2 = $_FILES["img2"]["name"];
		$vimage3 = $_FILES["img3"]["name"];
		$vimage4 = $_FILES["img4"]["name"];
		$vimage5 = $_FILES["img5"]["name"];
		$gpssystem = $_POST['gpssystem'];
		$electronicstabilitycontrol = $_POST['electronicstabilitycontrol'];
		$antilockbrakingsys = $_POST['antilockbrakingsys'];
		$brakeassist = $_POST['brakeassist'];
		$alloywheels = $_POST['alloywheels'];
		$airbags = $_POST['airbags'];
		$remotestartsystem = $_POST['remotestartsystem'];
		$smartstereointerface = $_POST['smartstereointerface'];
		$centrallocking = $_POST['centrallocking'];
		$adaptivecruisecontrol = $_POST['adaptivecruisecontrol'];
		move_uploaded_file($_FILES["img1"]["tmp_name"], "img/vehicleimages/" . $_FILES["img1"]["name"]);
		move_uploaded_file($_FILES["img2"]["tmp_name"], "img/vehicleimages/" . $_FILES["img2"]["name"]);
		move_uploaded_file($_FILES["img3"]["tmp_name"], "img/vehicleimages/" . $_FILES["img3"]["name"]);
		move_uploaded_file($_FILES["img4"]["tmp_name"], "img/vehicleimages/" . $_FILES["img4"]["name"]);
		move_uploaded_file($_FILES["img5"]["tmp_name"], "img/vehicleimages/" . $_FILES["img5"]["name"]);

		$sql = "INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,Price,FuelType,Engine,PeakTorque,PeakPower,Transmission,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,GPSSystem,ElectronicStabilityControl,AntiLockBrakingSystem,BrakeAssist,AlloyWheels,Airbags,RemoteStartSystem,SmartStereoInterface,CentralLocking,AdaptiveCruiseControl) VALUES(:vehicletitle,:brand,:vehicleoverview,:price,:fueltype,:engine,:peaktorque,:peakpower,:transmission,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:gpssystem,:electronicstabilitycontrol,:antilockbrakingsys,:brakeassist,:alloywheels,:airbags,:remotestartsystem,:smartstereointerface,:centrallocking,:adaptivecruisecontrol)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
		$query->bindParam(':brand', $brand, PDO::PARAM_STR);
		$query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
		$query->bindParam(':price', $price, PDO::PARAM_STR);
		$query->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
		$query->bindParam(':engine', $engine, PDO::PARAM_STR);
		$query->bindParam(':peaktorque', $peaktorque, PDO::PARAM_STR);
		$query->bindParam(':peakpower', $peakpower, PDO::PARAM_STR);
		$query->bindParam(':transmission', $transmission, PDO::PARAM_STR);
		$query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
		$query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
		$query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
		$query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
		$query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
		$query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
		$query->bindParam(':vimage5', $vimage5, PDO::PARAM_STR);
		$query->bindParam(':gpssystem', $gpssystem, PDO::PARAM_STR);
		$query->bindParam(':electronicstabilitycontrol', $electronicstabilitycontrol, PDO::PARAM_STR);
		$query->bindParam(':antilockbrakingsys', $antilockbrakingsys, PDO::PARAM_STR);
		$query->bindParam(':brakeassist', $brakeassist, PDO::PARAM_STR);
		$query->bindParam(':alloywheels', $alloywheels, PDO::PARAM_STR);
		$query->bindParam(':airbags', $airbags, PDO::PARAM_STR);
		$query->bindParam(':remotestartsystem', $remotestartsystem, PDO::PARAM_STR);
		$query->bindParam(':smartstereointerface', $smartstereointerface, PDO::PARAM_STR);
		$query->bindParam(':centrallocking', $centrallocking, PDO::PARAM_STR);
		$query->bindParam(':adaptivecruisecontrol', $adaptivecruisecontrol, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Vehicle posted successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
	}
?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Legal Machines | Admin Post Vehicle</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="../css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="../css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="../css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="../css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="../css/style.css">
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include('../includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title">Post A Vehicle</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="vehicletitle" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="brandname" required>
															<option value=""> Select </option>
															<?php $ret = "select id,BrandName from tblbrands";
															$query = $dbh->prepare($ret);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($results as $result) {
															?>
																	<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->BrandName); ?></option>
															<?php }
															} ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Vehical Overview<span style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea class="form-control" name="vehicalorcview" rows="3" required></textarea>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="modelyear" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="seatingcapacity" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Price (in INR)<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="price" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="fueltype" required>
															<option value=""> Select </option>
															<option value="Petrol">Petrol</option>
															<option value="Diesel">Diesel</option>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Engine<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="engine" class="form-control" required>
													</div>

													<label class="col-sm-2 control-label">Peak Torque<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="peaktorque" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Peak Power<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="peakpower" class="form-control" required>
													</div>

													<label class="col-sm-2 control-label">Transmission<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="transmission" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-12">
														<h4><b>Upload Images</b></h4>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-4">
														Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
													</div>
													<div class="col-sm-4">
														Image 2<span style="color:red">*</span><input type="file" name="img2" required>
													</div>
													<div class="col-sm-4">
														Image 3<span style="color:red">*</span><input type="file" name="img3" required>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-4">
														Image 4<span style="color:red">*</span><input type="file" name="img4" required>
													</div>
													<div class="col-sm-4">
														Image 5<input type="file" name="img5">
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Accessories</div>
										<div class="panel-body">
											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="gpssystem" name="gpssystem" value="1">
														<label for="gpssystem"> GPS System </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="electronicstabilitycontrol" name="electronicstabilitycontrol" value="1">
														<label for="electronicstabilitycontrol"> Electronic Stability Control </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
														<label for="antilockbrakingsys"> AntiLock Braking System </label>
													</div>
												</div>
												<div class="checkbox checkbox-inline">
													<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
													<label for="brakeassist"> Brake Assist </label>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="alloywheels" name="alloywheels" value="1">
														<label for="alloywheels"> Alloy Wheels </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="airbags" name="airbags" value="1">
														<label for="airbags"> Airbags </label>
													</div>
												</div>
												<div class="checkbox checkbox-inline">
													<input type="checkbox" id="remotestartsystem" name="remotestartsystem" value="1">
													<label for="remotestartsystem"> Remote Start System </label>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="smartstereointerface" name="smartstereointerface" value="1">
														<label for="smartstereointerface"> Smart Stereo Interface </label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox h checkbox-inline">
														<input type="checkbox" id="centrallocking" name="centrallocking" value="1">
														<label for="centrallocking">Central Locking</label>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<input type="checkbox" id="adaptivecruisecontrol" name="adaptivecruisecontrol" value="1">
														<label for="adaptivecruisecontrol"> Adaptive Cruise Control </label>
													</div>
												</div>
											</div><br><br><br>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-5">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap-select.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery.dataTables.min.js"></script>
		<script src="../js/dataTables.bootstrap.min.js"></script>
		<script src="../js/Chart.min.js"></script>
		<script src="../js/fileinput.js"></script>
		<script src="../js/chartData.js"></script>
		<script src="../js/main.js"></script>
	</body>

	</html>
<?php } ?>