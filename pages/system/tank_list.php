<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
include '../include/authen.php';
include "../include/function.php"; 
include '../include/database.php';
$db = new Database();  
$db->connect();

$sql = "select * from tbl_tank_list order by id";
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
              <h3>Tanks</h3>
              Tank List
            </div>
            <div class="col-5 text-right">
              
            </div>
          </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <!-- <h4 class="card-title">Dashboard</h4> -->
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
                            Product Name
                          </th>
                          <th>
                            Ownership (bbl)
                          </th>
                          <th>
                            Quantity in Tank (bbl)
                          </th>
                          <th>
                            Lastest update
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>

                        <? 
                          $k = 0;
                          $j = 0;

                          $tank_colors = array("blue", "green", "green", "blue", "blue");

                          $ran_num = array("28,115.4506", "28,138.0994", "67,480.2265", "39,970.48", "8,242.88");// array(28,1,4,3,1);
                          $ran_num2 = array("37,487.2676","28,138.094","40,488.136","79,940.96","2,060.72");//array(4,3,1,2,1);
                          $ran_num3 = array("28,115.4506","28,138.094","13,496.0543","19,985.24","4,121.44");//array(3,1,1,2,4);

                          $ran_num_combine = array("65,602.2675", "56,276.1934", "107,968.362", "119,911.44", "10,303.6");

                          $result = array("93,718.16900", "93,793.64672", "134,960.5317","199,852.42294","20,607.20014");
                          $perpiece = 9371.81687;

                          // foreach($res as $r) { 
                          for ($a = 0; $a<count($res); $a ++) {
                            $r = $res[$a];
                        ?>
                        <tr>
                          <td>
                            <?=($a+1)?>
                          </td>
                          <td>
                            <?=$r['title']?>
                            <!-- <a href="tank_detail.php?no=<?=$r['title']?>"><?=$r['title']?></a> -->
                          </td>
                          <td>
                            Gas Oil
                          </td>
                          <td>
                            <? 
                            // $ran_num = rand(1, 5);
                            // $ran_num2 = rand(1, 5);
                            // $ran_num3 = rand(1, 5);
                            ?>
                            <div class="jigsaw-container" style="flex:1;">
                              <div class="jigsaw-sm jigsaw-first jigsaw-<?=$tank_colors[$a]?> text-center">
                                <div class="row">
                                  <div class="col-12" title="Bank" style="padding-left: 30px; padding-right: 30px">
                                    <?=$ran_num_combine[$a]?>
                                  </div>
                                </div>
                              </div>

                              <!-- <div class="jigsaw-sm jigsaw-green text-center">
                                <div class="row">
                                  <div class="col-12" title="Company" style="padding-left: 30px; padding-right: 30px">
                                    <?=$ran_num2[$a]?>
                                  </div>
                                </div>
                              </div> -->

                              <div class="jigsaw-sm jigsaw-grey jigsaw-last text-center">
                                <div class="row">
                                  <div class="col-12" title="Empty" style="padding-left: 30px; padding-right: 30px">
                                    <?=$ran_num3[$a]?>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </td>
                          <td>
                            <?=$result[$a]?>
                          </td>
                          <td>
                            <?=$r['updatedate']?>
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

</body>

</html>
