<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DataTables | Gentallela</title>
    
    <?php include("includes/genericCSS.php"); ?>
    
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                    <h2>View Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Email</th>
                          <th>Admin</th>
                          <th>Teacher</th>
                          <th>Student</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                          if ($stmt = $mysqli->prepare("SELECT userEmail, userFirstName, userLastName, isAdmin, isTeacher, isStudent FROM users"))
                          {
                              if ($stmt->execute())
                              {
                                $stmt->bind_result($userEmail, $userFirstName, $userLastName, $isAdmin, $isTeacher, $isStudent);
                                $stmt->store_result();

                                while ($stmt->fetch())
                                {
                                    if ($isAdmin)
                                    {
                                      $isAdmin = '
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" disabled="disabled" checked="checked">
                                                    </label>
                                                  </div>
                                                ';
                                    }
                                    else
                                    {
                                      $isAdmin = '
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" disabled="disabled">
                                                    </label>
                                                  </div>
                                                ';
                                    }
                                    if ($isTeacher)
                                    {
                                      $isTeacher = '
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" disabled="disabled" checked="checked">
                                                    </label>
                                                  </div>
                                                ';
                                    }
                                    else
                                    {
                                      $isTeacher = '
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" disabled="disabled">
                                                    </label>
                                                  </div>
                                                ';
                                    }

                                    if ($isStudent)
                                    {
                                      $isStudent = '
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" disabled="disabled" checked="checked">
                                                    </label>
                                                  </div>
                                                ';
                                    }
                                    else
                                    {
                                      $isStudent = '
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" disabled="disabled">
                                                    </label>
                                                  </div>
                                                ';
                                    }

                            ?>
                                  <tr>
                                    <td><?php echo $userFirstName; ?></td>
                                    <td><?php echo $userLastName; ?></td>
                                    <td><?php echo $userEmail; ?></td>
                                    <td><?php echo $isAdmin; ?></td>
                                    <td><?php echo $isTeacher; ?></td>
                                    <td><?php echo $isStudent; ?></td>
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

    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
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
    <script src="vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>
