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

          <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <h4 class="card-title">Case Edit </h4>
                    </div>
                    <div class="col-md-8 text-right">
                      <button type="submit" class="btn btn-primary mr-2">Approve</button>
                      <button type="submit" class="btn btn-danger mr-2">Reject</button>
                    </div>
                    
                  </div>
                  

                  <form class="forms-sample" action="case_list.php">
                    <div class="form-group">
                      <label for="exampleInputName1">Title</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="Case Title Demo">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Documents</label>
                      <br>
                      <img src="../../images/invoice-uat01.png">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail3">Comments</label>
                      <input type="text"  class="form-control" id="exampleInputName1" placeholder="Name" value="Comment for this case.">
                    </div>


                    <button type="submit" class="btn btn-success mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                    
                  </form>
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
