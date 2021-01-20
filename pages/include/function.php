<!--/* Copyright (C) 2020 ShuttleOne - All Rights Reserved */-->
<?

function gererateRefNo() {
  return uniqid();
}

function progressSellBar($status) {
	if ($status == 0) 
		return processSellStart();
	if ($status == 1) 
		return processSellSubmit();
	if ($status == 2)
		return processSellApprove();
	if ($status == 3)
		return processSellAck();
	if ($status == 4)
		return processSellClose();
}

function processSellStart() {
	return '<div class="jigsaw-container" style="flex:1;">

        <div class="jigsaw jigsaw-first jigsaw-grey text-center">
          <div class="row">
            <div class="col-12">
              Submitted
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-spin fa-spinner"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-grey text-center">
          <div class="row">
            <div class="col-12">
              Approved
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-ban"></i>
            </div>
          </div>
        </div>


        <div class="jigsaw jigsaw-grey text-center">
          <div class="row">

            <div class="col-12">
              Acknowledged
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-ban"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-grey jigsaw-last text-center">
          <div class="row">
            <div class="col-12">
              Completed
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-ban"></i>
            </div>
          </div>
        </div>

      </div>';
}


function processSellApprove() {
	return '<div class="jigsaw-container" style="flex:1;">

        <div class="jigsaw jigsaw-first text-center">
          <div class="row">
            <div class="col-12">
              Submitted
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw text-center">
          <div class="row">
            <div class="col-12">
              Approved
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw-grey">
          <div class="arrow-right arrow-right-green">
          </div>
        </div>

        <div class="jigsaw jigsaw-grey text-center">
          <div class="row">

            <div class="col-12">
              Acknowledged
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-spin fa-spinner"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-grey jigsaw-last text-center">
          <div class="row">
            <div class="col-12">
              Completed
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-ban"></i>
            </div>
          </div>
        </div>

      </div>';
}

function processSellSubmit() {
	return '<div class="jigsaw-container" style="flex:1;">

        <div class="jigsaw jigsaw-first text-center">
          <div class="row">
            <div class="col-12">
              Submitted
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw-grey">
          <div class="arrow-right arrow-right-green">
          </div>
        </div>

        <div class="jigsaw jigsaw-grey text-center">
          <div class="row">
            <div class="col-12">
              Approved
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-spin fa-spinner"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-grey text-center">
          <div class="row">

            <div class="col-12">
              Acknowledged
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-ban"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-grey jigsaw-last text-center">
          <div class="row">
            <div class="col-12">
              Completed
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-ban"></i>
            </div>
          </div>
        </div>

      </div>';
}

function processSellAck() {
	return '<div class="jigsaw-container" style="flex:1;">

        <div class="jigsaw jigsaw-first text-center">
          <div class="row">
            <div class="col-12">
              Submitted
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-green text-center">
          <div class="row">
            <div class="col-12">
              Approved
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-green text-center">
          <div class="row">

            <div class="col-12">
              Acknowledged
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw-grey">
          <div class="arrow-right arrow-right-green">
          </div>
        </div>

        <div class="jigsaw jigsaw-grey jigsaw-last text-center">
          <div class="row">
            <div class="col-12">
              Completed
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-spin fa-spinner"></i>
            </div>
          </div>
        </div>

      </div>';
}

function processSellClose() {
	return '<div class="jigsaw-container" style="flex:1;">

        <div class="jigsaw jigsaw-first text-center">
          <div class="row">
            <div class="col-12">
              Submitted
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-green text-center">
          <div class="row">
            <div class="col-12">
              Approved
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-green text-center">
          <div class="row">

            <div class="col-12">
              Acknowledged
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

        <div class="jigsaw jigsaw-green jigsaw-last text-center">
          <div class="row">
            <div class="col-12">
              Completed
            </div>
            <div class="col-12 mt-2">
              <i class="fa fa-check"></i>
            </div>
          </div>
        </div>

      </div>';
}

?>