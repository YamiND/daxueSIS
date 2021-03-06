<?php
  include_once 'includes/dbConnect.php';
  include_once 'includes/functions.php';

  session_start();

  // Set permission restrictions here
  if (!isAdmin($mysqli))
  {
    header("Location: /page_403.php");

  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>View Classes</title>
    
    <?php include("includes/genericCSS.php"); ?>
    
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include("includes/navPanel.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Classes</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      
                      <thead>
                        <tr>
                          <th>Class Name</th>
                          <th>Teacher Name</th>
                          <th>Teacher Email</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                          if ($stmt = $mysqli->prepare("SELECT classes.className, classes.classStartTime, classes.classEndTime, users.userFirstName, users.userLastName, users.userEmail FROM users INNER JOIN (classes) ON (classes.classTeacherID = users.userID) INNER JOIN (schoolYear) ON (classes.schoolYearID = schoolYear.schoolYearID AND fallSemesterStart <= CURDATE() AND springSemesterEnd >= CURDATE())"))
                          {
                              if ($stmt->execute())
                              {
                                $stmt->bind_result($className, $classStartTime, $classEndTime, $teacherFirstName, $teacherLastName, $teacherEmail);
                                $stmt->store_result();

                                while ($stmt->fetch())
                                {
                            ?>
                                  <tr>
                                    <td><?php echo $className; ?></td>
                                    <td><?php echo "$teacherLastName, $teacherFirstName"; ?></td>
                                    <td><?php echo $teacherEmail; ?></td>
                                    <td><?php echo $classStartTime; ?></td>
                                    <td><?php echo $classEndTime; ?></td>
                                  </tr>
                            <?php
                                }
                              }
                          }
                      ?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include("includes/footer.php"); ?>
      </div>
    </div>

    <?php include("includes/genericJS.php"); ?>

    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {

        $('#datatable-responsive').DataTable();

      });
    </script>
    <!-- /Datatables -->
  </body>
</html>
