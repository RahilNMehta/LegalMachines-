<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_REQUEST['del'])) {
        $delid = intval($_GET['del']);
        $sql = "delete from tblvehicles WHERE id=:delid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':delid', $delid, PDO::PARAM_STR);
        $query->execute();
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

        <title>Legal Machines | Mercedes Dashboard</title>

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
    </head>

    <body>
        <?php include('../includes/header.php'); ?>
        <div class="ts-main-content">
            <?php include('includes/leftbar.php'); ?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title">Dashboard</h2>
                            <div class="panel panel-default">
                                <div class="panel-heading">Vehicle Details</div>
                                <div class="panel-body">
                                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Vehicle Title</th>
                                                <th>Fuel Type</th>
                                                <th>Model Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT id,VehiclesTitle,FuelType,ModelYear from tblvehicles where VehiclesBrand=11";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($result->VehiclesTitle); ?></td>
                                                        <td><?php echo htmlentities($result->FuelType); ?></td>
                                                        <td><?php echo htmlentities($result->ModelYear); ?></td>
                                                        <td><a href="edit-vehicle.php?id=<?php echo $result->id; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                            <a href="dashboard.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
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

        <script>
            window.onload = function() {
                // Line chart from swirlData for dashReport
                var ctx = document.getElementById("dashReport").getContext("2d");
                window.myLine = new Chart(ctx).Line(swirlData, {
                    responsive: true,
                    scaleShowVerticalLines: false,
                    scaleBeginAtZero: true,
                    multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
                });

                // Pie Chart from doughutData
                var doctx = document.getElementById("chart-area3").getContext("2d");
                window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
                    responsive: true
                });

                // Dougnut Chart from doughnutData
                var doctx = document.getElementById("chart-area4").getContext("2d");
                window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
                    responsive: true
                });
            }
        </script>
    </body>

    </html>
<?php } ?>