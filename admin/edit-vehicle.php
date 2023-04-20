<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
		$id = intval($_GET['id']);

		$sql = "update tblvehicles set VehiclesTitle=:vehicletitle,VehiclesBrand=:brand,VehiclesOverview=:vehicleoverview,Price=:price,FuelType=:fueltype,Engine=:engine,PeakTorque=:peaktorque,PeakPower=:peakpower,Transmission=:transmission,ModelYear=:modelyear,SeatingCapacity=:seatingcapacity,GPSSystem=:gpssystem,ElectronicStabilityControl=:electronicstabilitycontrol,AntiLockBrakingSystem=:antilockbrakingsys,BrakeAssist=:brakeassist,AlloyWheels=:alloywheels,Airbags=:airbags,RemoteStartSystem=:remotestartsystem,SmartStereoInterface=:smartstereointerface,CentralLocking=:centrallocking,AdaptiveCruiseControl=:adaptivecruisecontrol where id=:id ";
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
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		$msg = "Data updated successfully";
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

		<title>Legal Machines | Admin Edit Vehicle Info</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
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
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Edit Vehicle</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
										<div class="panel-body">
											<?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
											<?php
											$id = intval($_GET['id']);
											$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':id', $id, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>

													<form method="post" class="form-horizontal" enctype="multipart/form-data">
														<div class="form-group">
															<label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="vehicletitle" class="form-control" value="<?php echo htmlentities($result->VehiclesTitle) ?>" required>
															</div>
															<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="brandname" required>
																	<option value="<?php echo htmlentities($result->bid); ?>"><?php echo htmlentities($bdname = $result->BrandName); ?> </option>
																	<?php $ret = "select id,BrandName from tblbrands";
																	$query = $dbh->prepare($ret);
																	$query->execute();
																	$resultss = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($resultss as $results) {
																			if ($results->BrandName == $bdname) {
																				continue;
																			} else {
																	?>
																				<option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->BrandName); ?></option>
																	<?php }
																		}
																	} ?>

																</select>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Vehicle Overview<span style="color:red">*</span></label>
															<div class="col-sm-10">
																<textarea class="form-control" name="vehicalorcview" rows="3" required><?php echo htmlentities($result->VehiclesOverview); ?></textarea>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="modelyear" class="form-control" value="<?php echo htmlentities($result->ModelYear); ?>" required>
															</div>
															<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($result->SeatingCapacity); ?>" required>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Price (in INR)<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="price" class="form-control" value="<?php echo htmlentities($result->Price); ?>" required>
															</div>
															<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="fueltype" required>
																	<option value="<?php echo htmlentities($result->FuelType); ?>"> <?php echo htmlentities($result->FuelType); ?> </option>
																	<option value="Petrol">Petrol</option>
																	<option value="Diesel">Diesel</option>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Engine<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="engine" class="form-control" value="<?php echo htmlentities($result->Engine); ?>" required>
															</div>

															<label class="col-sm-2 control-label">Peak Torque<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="peaktorque" class="form-control" value="<?php echo htmlentities($result->PeakTorque); ?>" required>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Peak Power<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="peakpower" class="form-control" value="<?php echo htmlentities($result->PeakPower); ?>" required>
															</div>

															<label class="col-sm-2 control-label">Transmission<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="transmission" class="form-control" value="<?php echo htmlentities($result->Transmission); ?>" required>
															</div>
														</div>

														<div class="hr-dashed"></div>
														<div class="form-group">
															<div class="col-sm-12">
																<h4><b>Vehicle Images</b></h4>
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-4">
																Image 1 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" width="300" height="200" style="border:solid 1px #000">
																<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 1</a>
															</div>
															<div class="col-sm-4">
																Image 2 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>" width="300" height="200" style="border:solid 1px #000">
																<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 2</a>
															</div>
															<div class="col-sm-4">
																Image 3 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>" width="300" height="200" style="border:solid 1px #000">
																<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 3</a>
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-4">
																Image 4 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>" width="300" height="200" style="border:solid 1px #000">
																<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 4</a>
															</div>
															<div class="col-sm-4">
																Image 5
																<?php if ($result->Vimage5 == "") {
																	echo htmlentities("File not available");
																} else { ?>
																	<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage5); ?>" width="300" height="200" style="border:solid 1px #000">
																	<a href="changeimage5.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 5</a>
																<?php } ?>
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
													<?php if ($result->GPSSystem == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="gpssystem" checked value="1">
															<label for="inlineCheckbox1"> GPS System </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="gpssystem" value="1">
															<label for="inlineCheckbox1"> GPS System </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->ElectronicStabilityControl == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="electronicstabilitycontrol" checked value="1">
															<label for="inlineCheckbox2"> Electronic Stability Control </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="electronicstabilitycontrol" value="1">
															<label for="inlineCheckbox2"> Electronic Stability Control </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->AntiLockBrakingSystem == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="antilockbrakingsys" checked value="1">
															<label for="inlineCheckbox3"> AntiLock Braking System </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="antilockbrakingsys" value="1">
															<label for="inlineCheckbox3"> AntiLock Braking System </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->BrakeAssist == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="brakeassist" checked value="1">
															<label for="inlineCheckbox3"> Brake Assist </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="brakeassist" value="1">
															<label for="inlineCheckbox3"> Brake Assist </label>
														</div>
													<?php } ?>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-3">
													<?php if ($result->AlloyWheels == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="alloywheels" checked value="1">
															<label for="inlineCheckbox1"> Alloy Wheels </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="alloywheels" value="1">
															<label for="inlineCheckbox1"> Alloy Wheels </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->Airbags == 1) {
													?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="airbags" checked value="1">
															<label for="inlineCheckbox3"> Airbags </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="airbags" value="1">
															<label for="inlineCheckbox3"> Airbags </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->RemoteStartSystem == 1) { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="remotestartsystem" checked value="1">
															<label for="inlineCheckbox3"> Remote Start System </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="remotestartsystem" value="1">
															<label for="inlineCheckbox3"> Remote Start System </label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->SmartStereoInterface == 1) {
													?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="smartstereointerface" checked value="1">
															<label for="inlineCheckbox1"> Smart Stereo Interface </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="smartstereointerface" value="1">
															<label for="inlineCheckbox1"> Smart Stereo Interface </label>
														</div>
													<?php } ?>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-3">
													<?php if ($result->CentralLocking == 1) {
													?>
														<div class="checkbox  checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="centrallocking" checked value="1">
															<label for="inlineCheckbox2">Central Locking</label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="centrallocking" value="1">
															<label for="inlineCheckbox2">Central Locking</label>
														</div>
													<?php } ?>
												</div>

												<div class="col-sm-3">
													<?php if ($result->AdaptiveCruiseControl == 1) {
													?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="adaptivecruisecontrol" checked value="1">
															<label for="inlineCheckbox3"> Adaptive Cruise Control </label>
														</div>
													<?php } else { ?>
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="inlineCheckbox1" name="adaptivecruisecontrol" value="1">
															<label for="inlineCheckbox3"> Adaptive Cruise Control </label>
														</div>
													<?php } ?>
												</div>
											</div>













									<?php }
											} ?>


									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
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
			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap-select.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/jquery.dataTables.min.js"></script>
			<script src="js/dataTables.bootstrap.min.js"></script>
			<script src="js/Chart.min.js"></script>
			<script src="js/fileinput.js"></script>
			<script src="js/chartData.js"></script>
			<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>