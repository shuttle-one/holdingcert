<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?
include '../include/authen.php';
include '../include/function.php';
include '../include/database.php';

$role = $_SESSION['role'];

$db = new Database();  
$db->connect();

$sql = "select * from tbl_casetype";
$db->sql($sql);
$typeRes = $db->getResult();

$id = $_REQUEST['id'];
$ownerid = $_SESSION['id'];
$role = $_SESSION['role'];

$sql = "select * from tbl_case where id=" . $id;
$db->sql($sql);
$res = $db->getResult();

$sql = "select * from tbl_tank where caseid=" . $id;
$db->sql($sql);
$tankRes = $db->getResult();

$sql = "select * from tbl_upload_temp where caseid=" . $id . " order by id ";
$db->sql($sql);
$fileRes = $db->getResult();

$sql = "select * from tbl_tank_list";
$db->sql($sql);
$tankListRes = $db->getResult();

$buysell = $res[0]['buysell'];
$status = $res[0]['status'];
$tempid = 'temp_' . gererateRefNo();

$isOwner = false;
$canEdit = false;
$canUpload = false;
$canQuantity = false;
$canAcknowledge = false;

if ($ownerid==$res[0]['userid'])
  $isOwner = true;


if ($buysell=='sell') {
  if ($isOwner){
    if ($status == 1) {
      $canEdit = true;
      $canUpload = true;
      $canQuantity = true;
    }
  }

  if ($status==2)
    $canEdit = false;

  if ($status==2 && $role==2) {
    $canAcknowledge = true;
    $canQuantity = true;
    $canUpload = true;
  }

  if ($status==3 && $role==2) {
    $canUpload = true;
    $canQuantity = true;
  }

  if ($role==3) {
    $canQuantity = false;
    $canUpload = true;

    if ($status==1)
      $canQuantity = true;
  }

}

if ($buysell == 'buy') {
  $canQuantity = false;

  if ($isOwner){

    if ($status == 1) {
      $canEdit = true;
      $canUpload = true;
      $canQuantity = true;
    }
  }


  if ($role==3) {
    $canUpload = true;
    $canQuantity = false;
    if ($status==1)
      $canQuantity = true;
  }

  if ($status==2 && $role==2) {
    $canQuantity = true;
  }

  if ($role!=3 && !$isOwner) {
    $canAcknowledge = true;
    $canUpload = true;
  }


}

if ($status==4) { // COMPLETE
  $canEdit = false;
  $canUpload = false;
  $canAcknowledge = false;
}

// if ($status < 4) {
//   $canUpload = true;
// }

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
              <h3>Edit case</h3>
              <a href="dashboard.php">Dashboard</a> / Edit Case
            </div>
          </div>

          <div class="col-md-12 grid-margin stretch-card">

            <? if (count($res)==1) { ?>
              <div class="card">
                <div class="card-body">
                  
                  <form class="form-sample" id="frmcase" action="case_update.php" method="post" onsubmit="return checkUploadFile();">
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
                            <select class="form-control form-control-sm" name="casetype" <? if (!$canEdit) echo ' disabled'; ?> >
                              <? foreach($typeRes as $a) { ?>
                                <option value="<?=$a['id']?>" <? if ($res[0]['casetype']==$a['id']) echo 'selected';?>><?=$a['title']?></option>
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
                            <select class="form-control form-control-sm" name="buysell"<? if (!$canEdit) echo ' disabled'; ?>>
                              <option value="buy" <? if ($res[0]['buysell']=='buy') echo 'selected';?>>Client Buy</option>
                              <option value="sell" <? if ($res[0]['buysell']=='sell') echo 'selected';?>>Client Sell</option>
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
                            <input type="text" class="form-control form-control-sm" placeholder="Name of case" name="title" value="<?=$res[0]['title']?>" required="" <? if (!$canEdit) echo ' disabled'; ?> maxlength="200"/>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Trade Number</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Input the trade number" name="tradeno" value="<?=$res[0]['tradeno']?>" required=""<? if (!$canEdit) echo ' disabled'; ?> maxlength="40"/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Transport Unit</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Input the transport unit" name="transportunit" value="<?=$res[0]['transportunit']?>" required="" <? if (!$canEdit) echo ' disabled'; ?> maxlength="200"/>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <label>Client Name</label>
                            <select class="form-control form-control-sm" name="clientname" <? if (!$canEdit) echo ' disabled'; ?>>
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
                    <? if (count($tankRes)==0) { ?>
                      <div class="row element" id='div_<?=($i+1)?>'>
                      </div>
                    <? } ?>
                    <? for ($i=0;$i<count($tankRes);$i++) { ?>
                      <div class="row element" id='div_<?=($i+1)?>'>
                        <div class="col-md-3">
                          <div class="row">
                            <div class="col-sm-12">
                              <!-- <input type="text" class="form-control form-control-sm"  placeholder="Input the tank number" name="tankno[]" value="<?=$tankRes[$i]['tankno']?>"<? if (!$canEdit) echo ' disabled'; ?> /> -->

                              <select class="form-control form-control-sm" name="tankno[]" <?if (!$canQuantity) echo ' disabled';?>>
                                <? for($j=0;$j<count($tankListRes); $j++) { ?>
                                  <option value="<?=$tankListRes[$j]['title']?>"<? if ($tankRes[$i]['tankno']==$tankListRes[$j]['title']) echo ' selected';?>><?=$tankListRes[$j]['title']?></option>
                                <? } ?>
                              </select>

                            </div>
                          </div>
                        </div>


                        <div class="col-md-3">
                          <div class="row">
                            <div class="col-sm-12">
                              <!-- <input type="text" class="form-control form-control-sm" placeholder="Input the Product Name" name="productname[]" value="<?=$tankRes[$i]['productname']?>" required=""<? if (!$canEdit) echo ' disabled'; ?>/> -->

                              <select class="form-control form-control-sm" name="productname[]"<?if (!$canQuantity) echo ' disabled';?>>
                                <option value="Gas Oil">Gas Oil</option>
                              </select>

                            </div>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="row">
                            <div class="col-sm-12">
                              <input type="text" class="form-control form-control-sm" placeholder="" name="mt[]" value="<?=$tankRes[$i]['mt']?>" required="" <?if (!$canQuantity) echo ' disabled';?>/>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="row">
                            <div class="col-sm-12">
                              <input type="text" class="form-control form-control-sm" placeholder="" name="bbl[]" value="<?=$tankRes[$i]['bbl']?>" required=""<?if (!$canQuantity) echo ' disabled';?> />
                            </div>
                          </div>
                        </div>

                        <? if ($canQuantity && $isOwner) {?>
                        <div class="col-md-2">
                          <div class="row">
                            <div class="col-sm-12">
                              <a class="remove" id="remove_<?=$i+1?>">
                                <i class="mdi mdi-delete" style="font-size: 20px; color: red;"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                        <? } ?>
                      </div>
                  <? } ?>
                  </div>

                    <? if ($canQuantity && $isOwner) {?>
                    <div class="col-12 mt-3">
                      <button type="button" class="btn btn-block" id="btn_add">
                       + Add Tank
                      </button>
                    </div>
                    <? } ?>

                    <br>
                    <!---- UPLOPAD SECTION -->
                    <!---- CASE HAS ACKNOKEDGED -->
                    <? if ($canUpload) { ?>

                    <div class="row">
                      <div class="col-12">
                        <div class="dropzone-wrapper">
                          <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <p><i class="mdi mdi-cloud-upload icon-lg" style="size: 24px; height: 60px;"></i>Choose an image file or drag it here.</p>
                          </div>
                          <input type="file" name="img_logo" class="dropzone" id="file_upload">
                        </div>
                        <div class="text-center">
                                <!-- <button class="btn btn-success">Upload</button> -->
                          Accept formats: .pdf. Maximum upload file size 10MB.
                        </div>
                              
                      </div>
                    </div>
                    <? } ?>
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

                    <div id="file_row">
                    <? for ($i=0;$i<count($fileRes);$i++) { ?>
                      <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <a href="../upload_file/<?=$fileRes[$i]['title']?>" target="_blank"><?=$fileRes[$i]['title']?></a>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <?=$fileRes[$i]['uploadby']?>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <input type="hidden" name="fileid[]" value="<?=$fileRes[$i]['id']?>">
                          <input type="text" class="form-control form-control-sm" name="file_remark[]" value="<?=$fileRes[$i]['remark']?>"<?if (!$canUpload) echo ' disabled';?>>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <?=$fileRes[$i]['createdate']?>
                        </div>
                      </div>

                      <? if ($canUpload && ($_SESSION['username']==$fileRes[$i]['uploadby'])) { ?>
                      <div class="col-md-1">
                        <div class="form-group">
                          <a href="javascript:removeFile(<?=$fileRes[$i]['id']?>)">Delete</a>
                        </div>
                      </div>
                      <? } ?>
                    </div>
                    <? } ?>
                    </div>
                    
                    <!-- END UPLOAD SECTION -->

                    <input type="hidden" name="id" value="<?=$id?>">
                    <input type="hidden" name="tempid" value="<?=$tempid?>">
                    <input type="hidden" name="status" value="<?=$status?>">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Comment</label>
                          <div class="col-sm-12">
                            <textarea class="form-control form-control-sm" rows="5" name="comment"><?=$res[0]['comment']?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <? if ($canEdit || $canUpload) { ?>
                      <button type="submit" class="btn btn-success mr-2">Update</button>
                    <? } ?>
                    <!-- <? if ($ownerid==$res[0]['userid'] && $status==0) { ?>
                      
                      <button type="button" class="btn btn-primary mr-2" id="btn_submit">Submit</button>
                    <? } ?> -->

                    <? if ($canAcknowledge) { //===== WAIT FOR ACKNOWLEDGE ?>
                      <button type="button" class="btn btn-primary mr-2" id="btn_ack">Acknowledge</button>
                    <? } ?>

                    <? if (($role==3) && $status==1) { ?>
                      <button type="button" class="btn btn-primary mr-2" id="btn_approve">Approve</button>
                    <? } ?>

                    <? if (($role==3) && $status==3) { ?>
                      <button type="button" class="btn btn-primary mr-2" id="btn_acomplete">Complete</button>
                    <? } ?>

                    <!-- <button type="button" class="btn btn-primary mr-2" id="btn_default">Default</button>
                    <button type="button" class="btn btn-primary mr-2" id="btn_submit">Submit</button>
                    
                    <button type="button" class="btn btn-primary mr-2" id="btn_ack">Acknowledge</button> -->

                    <button type="button" class="btn btn-light" id=btn_back>Cancel</button>
                    <input type="hidden" name="process" id="process" value="">
                  </form>
                </div>
              </div>

            <? } else { ?>
              <div class="card">
                <div class="card-body">
                  Not found this case.
                </div>
              </div>
            <? } ?>
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

  $("#btn_default").click(function() {
    alert("Defaut");
    $("#process").val("default");
    $("#frmcase").submit();

    // window.location.href = "case_process.php?id=<?=$id?>&cmd=default";
  });

  $("#btn_submit").click(function() {
    alert("Submit");
    $("#process").val("submit");
    $("#frmcase").submit();
    // window.location.href = "case_process.php?id=<?=$id?>&cmd=submit";
  });

  $("#btn_approve").click(function() {
    alert("Approve");
    $("#process").val("approve");
    $("#frmcase").submit();
    // window.location.href = "case_process.php?id=<?=$id?>&cmd=approve";
  });

  $("#btn_acomplete").click(function() {
    alert("Complete");
    $("#process").val("complete");
    $("#frmcase").submit();
    // window.location.href = "case_process.php?id=<?=$id?>&cmd=complete";
  });

  $("#btn_ack").click(function() {
    alert("Acknowledge");
    $("#process").val("ack");
    $("#frmcase").submit();
    // window.location.href = "case_process.php?id=<?=$id?>&cmd=ack";
  });

  var rowcount = 0;
  var tankcount = 1;
  var filecount = <?=count($fileRes)?>;

  $(".dropzone").change(function() {


    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    // console.log(size);
    if (size > 10.5) { 
      alert("File must less than 10 MB");
      return;
    }
    var fd = new FormData(); 
    var files = $('#file_upload')[0].files[0]; 
    fd.append('file', files); 
    fd.append('tempid', '<?=$id?>');
    $('#file_upload').val('');
    $.ajax({ 
        url: '../upload/upload.php', 
        type: 'post', 
        data: fd, 
        contentType: false, 
        processData: false, 
        success: function(response){ 
          
          var a = JSON.parse(response);
          var arr = a['data'];
          if (a['code']==0) {
            filecount = arr.length;
            for (i=0;i<arr.length;i++) {
              var newrow = getUploadRow(arr[i],"<?=$_SESSION['username']?>");
              console.log(newrow);
              $("#file_row").append(newrow);
            }
          }else {
            alert("Error : " + a['data']);
          }

        }, 
    });
  });

  function loadFile() {
    var fd = new FormData(); 
    fd.append('temp', 1); 
    fd.append('id', '<?=$id?>');
    fd.append('tempid','<?=$tempid?>');

    $.ajax({ 
        url: '../upload/getfilelist.php', 
        type: 'post', 
        data: fd,
        contentType: false, 
        processData: false, 
        success: function(response){ 
          $("#file_row").empty();
          var a = JSON.parse(response);
          var arr = a['data'];
          // $("#file_row").empty();
          filecount = arr.length;
          for (i=0;i<arr.length;i++) {
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
        . '    <select class="form-control form-control-sm" name="tankno[]" >';

          foreach($tankListRes as $r) {
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
      alert("Please upload atleast 1 supporting document to submit case");
      return false
    }
    return true;
  }

  
</script>

</html>
