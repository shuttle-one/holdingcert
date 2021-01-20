<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
include '../include/authen.php';
include "../include/function.php"; 
include '../include/database.php';
$db = new Database();  
$db->connect();

$ownerid = $_SESSION['id'];
$role = $_SESSION['role'];

//-- STATUS

//--------------

$sql = "select c.*,t.title as casetitle from tbl_case c left join tbl_casetype t on c.casetype=t.id where c.userid=$ownerid or c.status>=2 order by c.id desc";

if ($role == 3) { //===== FINANCIER
  $sql = "select c.*,t.title as casetitle from tbl_case c left join tbl_casetype t on c.casetype=t.id  where c.status>=1 order by c.id desc";
}

$db->sql($sql);
$res = $db->getResult();


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
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-6 ml-3 mb-3">
              <h3>Dashboard</h3>
              Dashboard
            </div>
            <div class="col-5 text-right">
              <?// if (($role == 2) || ($role == 1 )) { ?>
              <? if ($role==1) { ?>
                <button class="btn btn-success" id="btn_add">+ Add case</button>
              
              <? } ?>
            </div>
          </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <!-- <h4 class="card-title">Dashboard</h4> -->
                    <div class="table-responsive">
                      <table id="dtBasicExample" class="table table-sm">
                        <thead>
                          <tr>
                            <th>
                              #
                            </th>
                            <th>
                              Case Title
                            </th>
                            <th>
                              Trade No.
                            </th>
                            <th>
                              Create Date
                            </th>
                            <th>
                              Type
                            </th>
                            <th width="10%">
                              Progress
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                        <? for ($i=0;$i<count($res);$i++) {  ?>
                          <tr>
                            <td>
                              <?=$i+1?>
                            </td>
                            <td>
                              <a href="case_edit.php?id=<?=$res[$i]['id']?>"><?=$res[$i]['title']?></a>
                            </td>
                            <td>
                              <?=$res[$i]['tradeno']?>
                            </td>
                            <td>
                              <?=$res[$i]['updatedate']?>
                            </td>
                            <td>
                              <?=$res[$i]['casetitle']?><br>
                              <? if ($res[$i]['buysell'] == 'buy') { ?>
                                <label class="badge badge-danger">Client Buy</label>
                              <? } else if ($res[$i]['buysell'] == 'sell') { ?>
                                <label class="badge badge-success">Client Sell</label>
                              <? } ?>

                            </td>
                            <td>
                              <? 

                                $test = progressSellBar($res[$i]['status']);
                                echo $test;
                              ?>
                            </td>
                          </tr>
                        <? } ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>

        </div>
      </div>

    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <script>
    $("#btn_add").click(function() {
      window.location.href="create.php";
    });

    $(document).ready(function () {
      $('#dtBasicExample').DataTable({
        "ordering": false
      });

      $('.dataTables_length').addClass('bs-select');
    });

  </script>
</body>

</html>
