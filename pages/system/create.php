<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
include '../include/function.php';
include '../include/authen.php';
include '../include/database.php';
$db = new Database();  
$db->connect();

$sql = "select * from tbl_casetype";
$db->sql($sql);
$typeRes = $db->getResult();

$sql = "select * from tbl_tank_list";
$db->sql($sql);
$tankRes = $db->getResult();

$tempid = 'temp_' . gererateRefNo();

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

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-6 ml-3 mb-3">
              <h3>Add case </h3>
              <a href="dashboard.php">Dashboard</a> / Add Case
            </div>
          </div>

          <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <form class="form-sample" action="case_create.php" method="post" onsubmit="return checkUploadFile();">
                    <div class="row">
                      <div class="col-12">
                        <h4>Case information</h4>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Type of case</label>
                          <div class="col-sm-12">
                            <select class="form-control form-control-sm" name="casetype">
                              <? foreach($typeRes as $a) { ?>
                                <option value="<?=$a['id']?>"><?=$a['title']?></option>
                              <? } ?>
                            </select>

                            <!-- <input type="text" class="form-control form-control-sm" style="font-weight: bold" /> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Buy/Sell</label>
                          <div class="col-sm-12">
                            <select class="form-control form-control-sm" name="buysell">
                              <option value="buy">Client Buy</option>
                              <option value="sell">Client Sell</option>
                            </select>

                            <!-- <input type="text" class="form-control form-control-sm" style="font-weight: bold" /> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Title</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Name of case" name="title" required="" maxlength="200" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Trade Number</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Input the trade number" name="tradeno" required="" maxlength="40"/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Transport Unit</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Input the transport unit" name="transportunit" required="" maxlength="200"/>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Client Name</label>
                            <select class="form-control form-control-sm" name="clientname">
                              <option value="Trafigura"<? if ($res[0]['clientname']=='Trafigura') echo ' selected';?>>Trafigura</option>
                              <? if ($role==2) { ?>
                                <option value="Oil Tranking"<? if ($res[0]['clientname']=='Oil Tranking') echo ' selected';?>>Oil Tranking</option>
                              <? } else if ($role==3) { ?>
                                <option value="SCB"<? if ($res[0]['clientname']=='SCB') echo ' selected';?>>SCB</option>
                              <? } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <br>

                    <!-- ROW HEADER -->
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Tank Numbers</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Product Name</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Quantity (MT)</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Quantity (BBL)</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <!-- <label><a href="">Add Row</a></label> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- END ROW HEADER -->  
                    <!-- START EACH ROW -->
                    <div id="div_tank">
                    <? for ($i=0;$i<1;$i++) { ?>
                      <div class="row element" id='div_1'>
                        <div class="col-md-3">
                          <div class="row">
                            <div class="col-sm-12">
                              <!-- <input type="text" class="form-control form-control-sm"  placeholder="Input the tank number" name="tankno[]" /> -->
                              <select class="form-control form-control-sm" name="tankno[]">
                                <? foreach ( $tankRes as $t) { ?>
                                <option value="<?=$t['title']?>"><?=$t['title']?></option>
                                <? } ?>
                                
                              </select>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-3">
                          <div class="row">
                            <div class="col-sm-12">
                              <select class="form-control form-control-sm" name="productname[]">
                                <option value="Gas Oil">Gas Oil</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="row">
                            <div class="col-sm-12">
                              <input type="text" class="form-control form-control-sm" placeholder="" name="mt[]" required="" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="row">
                            <div class="col-sm-12">
                              <input type="text" class="form-control form-control-sm" placeholder="" name="bbl[]" required="" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="row">
                            <div class="col-sm-12">
                              <a class="remove" id="remove_<?=$i+1?>">
                                <i class="mdi mdi-delete" style="font-size: 20px; color: red;"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <? } ?>
                    </div>


                    <div class="col-12 mt-3">
                      <button type="button" class="btn btn-block" id="btn_add">
                       + Add Tank
                      </button>
                    </div>
                    <br>

                    <!-- ATTACH FILE -->
                    <div class="row">
                      <div class="col-12">
                        <div class="dropzone-wrapper">
                          <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <p><i class="mdi mdi-cloud-upload icon-lg" style="size: 24px; height: 60px;"></i>Choose an image file or drag it here.</p>
                          </div>
                          <input type="file" name="file_upload" class="dropzone" id="file_upload">
                        </div>
                        <div class="text-center">
                          Accept formats:  .pdf. Maximum upload file size 10MB.
                        </div>
                              
                      </div>
                    </div>
                    
                    <br>
                    <p class="card-description">
                      Document attached
                    </p>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label" style="text-decoration: underline;">File name</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label" style="text-decoration: underline;">Uploaded by</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label" style="text-decoration: underline;">Remark</label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="col-form-label" style="text-decoration: underline;">Uploaded on</label>
                        </div>
                      </div>
                    </div>

                    <? for ($i=0;$i<1;$i++) { ?>
                      <div id="file_row">
                      </div>
                    <? } ?>
                    <input type="hidden" name="tempid" value="<?=$tempid?>">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Comment</label>
                          <div class="col-sm-12">
                            <textarea class="form-control form-control-sm" rows="5" name="comment"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Create</button>
                    <button type="button" class="btn btn-light" id=btn_back>Cancel</button>

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
<script type="text/javascript" src="../../js/custom.js"></script>
<script>
  $("#btn_back").click(function() {
    window.location.href = "dashboard.php";
  });

  var rowcount = 0;
  var tankcount = 1;
  var filecount = 0;

  $(".dropzone").change(function() {
    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    console.log(size);
    if (size > 10.5) { 
      alert("File must less than 10 MB");
      return;
    }

    var fd = new FormData(); 
    var files = $('#file_upload')[0].files[0]; 
    fd.append('file', files); 
    fd.append('tempid', '<?=$tempid?>');
    $('#file_upload').val('');
    $.ajax({ 
        url: '../upload/upload.php', 
        type: 'post', 
        data: fd, 
        contentType: false, 
        processData: false, 
        success: function(response){ 
          console.log(response);

          var a = JSON.parse(response);
          var arr = a['data'];
          if (a['code']==0){
            filecount = arr.length;
            for (i=0;i<arr.length;i++) {
              var newrow = getUploadRow(arr[i],"<?=$_SESSION['username']?>");
              $("#file_row").append(newrow);
            }
          }else {
            alert("Error : " + a['data']);
          }
        },
        error: function(){
          alert('error!');
        }
    });
  });

  function loadFile() {
    var fd = new FormData(); 
    fd.append('temp', 1); 
    fd.append('id', '<?=$tempid?>');
    fd.append('tempid','');
    $.ajax({ 
        url: '../upload/getfilelist.php', 
        type: 'post', 
        data: fd,
        contentType: false, 
        processData: false, 
        success: function(response){ 
          var a = JSON.parse(response);
          var arr = a['data'];
          $("#file_row").empty();
          filecount = arr.length;
          for (i=0;i<arr.length;i++) {
            console.log(arr[i].remark);
            var newrow = getUploadRow(arr[i],"<?=$_SESSION['username']?>");
            $("#file_row").append(newrow);
          }
        }, 
    });
  }

  function removeFile(fileid) {

    if (!confirm("Confirm delete this.")) {

    }else {
      var fd = new FormData(); 
      fd.append('temp', 1); 
      fd.append('id', '<?=$tempid?>');
      fd.append('fileid', fileid);

      $.ajax({ 
          url: '../upload/file_remove.php', 
          type: 'post', 
          data: fd,
          contentType: false, 
          processData: false, 
          success: function(response){ 
            loadFile();
          }, 
      });
    }
  }

  $(document).ready(function(){

     // Add new element
     $("#btn_add").click(function(){

      // Finding total number of elements added
      var total_element = $(".element").length;
     
      // last <div> with element class id
      var lastid = $(".element:last").attr("id");
      var split_id = lastid.split("_");
      var nextindex = Number(split_id[1]) + 1;

      var max = 99;
      // Check total number elements
      if(total_element < max ){
       // Adding new div container after last occurance of element class
       var html = getTankRow(nextindex, getTankDropdown());
       console.log("add new index " + nextindex);

       $(".element:last").after("<div class='element' id='divs_"+ nextindex +"'></div>");
     
       // Adding element to <div>
       $("#divs_" + nextindex).append(html);
        tankcount ++;
      }
     
     });

     // Remove element
     $('#div_tank').on('click','.remove',function(){
      if (tankcount == 1) {
        return;
      }

      var id = this.id;
      console.log('delet ' + id);
      var split_id = id.split("_");
      var deleteindex = split_id[1];
      console.log(deleteindex);

      // Remove <div> with id
      $("#div_" + deleteindex).remove();
      tankcount --;

     }); 
  });

  function getTankDropdown(){
    var r = '';
    <?
      $tankdd =  '      <div class="col-md-3">'
        . '        <div class="row"> '
        . '          <div class="col-sm-12">'
        . '    <select class="form-control form-control-sm" name="tankno[]">';

          foreach($tankRes as $r) {
            $tankdd .= '        <option value="'. $r['title'] . '">' . $r['title'] . '</option>';
          }

      $tankdd  .= '    </select>'
        . '          </div>'
        . '        </div>'
        . '      </div>';

        echo " r = '" . $tankdd . "';";
    
    ?>
    return r;
  }

  function checkUploadFile() {
    if (filecount < 1) {
      alert("Please upload at least 1 supporting document to submit case");
      return false
    }
    return true;
  }
  

</script>

</html>
