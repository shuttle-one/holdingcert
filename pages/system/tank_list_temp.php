<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
$menuid = 4;
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
                  <h4 class="card-title">Tank list</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Tank Name
                          </th>
                          <th>
                            Quantity
                          </th>
                          <th>
                            Lastest update
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            1
                          </td>
                          <td>
                            Tank name 1
                          </td>
                          <td>
                            3
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td>
                            2
                          </td>
                          <td>
                            Tank name 2
                          </td>
                          <td>
                            5
                          </td>
                          <td>
                            July 1, 2015
                          </td>
                        </tr>
                        <tr>
                          <td>
                            3
                          </td>
                          <td>
                            Tank name 3
                          </td>
                          <td>
                            11
                          </td>
                          <td>
                            Apr 12, 2015
                          </td>
                        </tr>
                        <tr>
                          <td>
                            4
                          </td>
                          <td>
                            Tank name 4
                          </td>
                          <td>
                            3
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td>
                            5
                          </td>
                          <td>
                            Tank name 5
                          </td>
                          <td>
                            1
                          </td>
                          <td>
                            May 03, 2015
                          </td>
                        </tr>
                        <tr>
                          <td>
                            6
                          </td>
                          <td>
                            Tank name 6
                          </td>
                          <td>
                            2
                          </td>
                          <td>
                            April 05, 2015
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
