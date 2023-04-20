<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
  //$fromdate = $_POST['fromdate'];
  //$todate = $_POST['todate'];
  $message = $_POST['message'];
  $useremail = $_SESSION['login'];
  $status = 0;
  $vhid = $_GET['vhid'];
  $bookingno = mt_rand(100000000, 999999999);
  //$ret = "SELECT * FROM tblbooking where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid";
  $ret = "SELECT * FROM tblbooking where VehicleId=:vhid";
  $query1 = $dbh->prepare($ret);
  $query1->bindParam(':vhid', $vhid, PDO::PARAM_STR);
  //$query1->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
  //$query1->bindParam(':todate', $todate, PDO::PARAM_STR);
  $query1->execute();
  $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

  if ($query1->rowCount() == 0) {
    // $sql = "INSERT INTO  tblbooking(BookingNumber,userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:bookingno,:useremail,:vhid,:fromdate,:todate,:message,:status)";
    $sql = "INSERT INTO  tblbooking(BookingNumber,userEmail,VehicleId,message,Status,PostingDate) VALUES(:bookingno,:useremail,:vhid,:message,:status,:PostingDate)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    //$query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    //$query->bindParam(':todate', $todate, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':PostingDate', $PostingDate, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
      echo "<script>alert('Booking successfull.');</script>";
      echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again');</script>";
      echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
    }
  } else {
    echo "<script>alert('Car already booked for these days');</script>";
    echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
  }
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Legal Machines | Vehicle Details</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <!--Custome Style -->
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <!--slick-slider -->
  <link href="assets/css/slick.css" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <!--FontAwesome Font Style -->
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">

  <!-- SWITCHER -->
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="shortcut icon" href="assets/images/LM.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>
  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!--Listing-Image-Slider-->
  <?php
  $vhid = intval($_GET['vhid']);
  $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      $_SESSION['brndid'] = $result->bid;
  ?>

      <section id="listing_img_slider">
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
        <?php if ($result->Vimage5 == "") {
        } else {
        ?>
          <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
        <?php } ?>
      </section>
      <!--/Listing-Image-Slider-->

      <!--Listing-detail-->
      <section class="listing-detail">
        <div class="container">
          <div class="listing_detail_head row">
            <div class="col-md-9">
              <h2><?php echo htmlentities($result->VehiclesTitle); ?></h2>
            </div>
            <div class="col-md-3">
            </div>
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="main_features">
                <ul>
                  <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->ModelYear); ?></h5>
                    <p>Reg. Year</p>
                  </li>
                  <li> <i class="fa fa-dashboard" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->FuelType); ?></h5>
                    <p>Fuel Type</p>
                  </li>
                  <li> <i class="fa fa-group" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->SeatingCapacity); ?></h5>
                    <p>Seats</p>
                  </li>
                  <li> <i class="fa fa-steam" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->Engine); ?></h5>
                    <p>Engine</p>
                  </li>
                  <li> <i class="fa fa-ge" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->PeakTorque); ?></h5>
                    <p>Peak Torque</p>
                  </li>
                  <li><i class="fa fa-flash" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->PeakPower); ?></h5>
                    <p>Peak Power</p>
                  </li>
                  <li> <i class="fa fa-gears" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->Transmission); ?></h5>
                    <p>Transmission</p>
                  </li>
                  <li> <i class="fa fa-inr" aria-hidden="true"></i>
                    <h5><?php echo htmlentities($result->Price); ?></h5>
                    <p>Rupees</p>
                  </li>
                </ul>
              </div>
              <div class="listing_more_info">
                <div class="listing_detail_wrap">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs gray-bg" role="tablist">
                    <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
                    <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- vehicle-overview -->
                    <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                      <p><?php echo htmlentities($result->VehiclesOverview); ?></p>
                    </div>

                    <!-- Accessories -->
                    <div role="tabpanel" class="tab-pane" id="accessories">
                      <!--Accessories-->
                      <table>
                        <thead>
                          <tr>
                            <th colspan="2">Accessories</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>GPS System</td>
                            <?php if ($result->GPSSystem == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Electronic Stability Control</td>
                            <?php if ($result->ElectronicStabilityControl == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>AntiLock Braking System</td>
                            <?php if ($result->AntiLockBrakingSystem == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Brake Assist</td>
                            <?php if ($result->BrakeAssist == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Alloy Wheels</td>
                            <?php if ($result->AlloyWheels == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Airbags</td>
                            <?php if ($result->Airbags == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Remote Start System</td>
                            <?php if ($result->RemoteStartSystem == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Smart Stereo Interface</td>
                            <?php if ($result->SmartStereoInterface == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Central Locking</td>
                            <?php if ($result->CentralLocking == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php  } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                          <tr>
                            <td>Adaptive Cruise Control</td>
                            <?php if ($result->AdaptiveCruiseControl == 1) { ?>
                              <td><i class="fa fa-check" aria-hidden="true"></i></td>
                            <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                            <?php } ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
      } ?>

            </div>
            <!--Side-Bar-->
            <aside class="col-md-3">
              <div class="share_vehicle">
                <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
              </div>
              <div class="sidebar_widget">
                <div class="widget_heading">
                  <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
                </div>
                <form method="post">
                  <div class="form-group">
                    <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                  </div>
                  <?php if ($_SESSION['login']) { ?>
                    <div class="form-group">
                      <input type="submit" class="btn" name="submit" value="Book Now">
                    </div>
                  <?php } else { ?>
                    <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login To Book</a>
                  <?php } ?>
                </form>
              </div>
            </aside>
            <!--/Side-Bar-->
          </div>

          <div class="space-20"></div>
          <div class="divider"></div>

          <!--Similar-Cars-->
          <div class="similar_cars">
            <h3>Similar Cars</h3>
            <div class="row">
              <?php
              $bid = $_SESSION['brndid'];
              //$sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:bid";
              $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.Price,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:bid";
              $query = $dbh->prepare($sql);
              $query->bindParam(':bid', $bid, PDO::PARAM_STR);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <div class="col-md-3 grid_listing">
                    <div class="product-listing-m gray-bg">
                      <div class="product-listing-img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="image" /> </a>
                      </div>
                      <div class="product-listing-content">
                        <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"> <?php echo htmlentities($result->VehiclesTitle); ?></a></h5>
                        <ul class="features_list">
                          <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> Seats</li>
                          <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> Model</li>
                          <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
              <?php }
              } ?>
            </div>
          </div>
          <!--/Similar-Cars-->
        </div>
      </section>
      <!--/Listing-detail-->

      <!--Footer -->
      <?php include('includes/footer.php'); ?>
      <!-- /Footer-->

      <!--Back to top-->
      <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
      <!--/Back to top-->

      <!--Login-Form -->
      <?php include('includes/login.php'); ?>
      <!--/Login-Form -->

      <!--Register-Form -->
      <?php include('includes/registration.php'); ?>
      <!--/Register-Form -->

      <!--Forgot-password-Form -->
      <?php include('includes/forgotpassword.php'); ?>

      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/interface.js"></script>
      <script src="assets/switcher/js/switcher.js"></script>
      <script src="assets/js/bootstrap-slider.min.js"></script>
      <script src="assets/js/slick.min.js"></script>
      <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>