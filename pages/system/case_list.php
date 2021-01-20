<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
$menuid = 3;
?>
<!DOCTYPE html>
<html lang="en">

<? include '../include/header.php';?>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <? include '../include/nav_bar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      
      <? include '../include/left_menu.php'; ?>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Case List : Wait for approve</h4>

                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Case Title
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Doc
                          </th>
                          <th>
                            Create Date
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            1
                          </td>
                          <td>
                            16325EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            2
                          </td>
                          <td>
                            16324EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td>
                            July 1, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            3
                          </td>
                          <td>
                            16323EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $138.00
                          </td>
                          <td>
                            Apr 12, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            4
                          </td>
                          <td>
                            16320EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            5
                          </td>
                          <td>
                            16318EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 160.25
                          </td>
                          <td>
                            May 03, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            6
                          </td>
                          <td>
                            16317EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 123.21
                          </td>
                          <td>
                            April 05, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            7
                          </td>
                          <td>
                            16316EMMAMAERSK
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 150.00
                          </td>
                          <td>
                            June 16, 2015
                          </td>
                          <td>
                            <a href="case_view.php"><label class="badge badge-success">Edit</label></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <? include '../include/footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <? include '../include/script.php'; ?>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
