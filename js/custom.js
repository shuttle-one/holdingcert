function getTankRow(id, tanklist) {
    return '<div class="row element" id="div_' + id + '">'

        // + '      <div class="col-md-3">'
        // + '        <div class="row"> '
        // + '          <div class="col-sm-12">'
        // + '    <select class="form-control form-control-sm" name="tankno[]">'
        //     + '        <option value="Tank 1">Tank 1</option>'
        //     + '        <option value="Tank 2">Tank 2</option>'
        //     + '        <option value="Tank 3">Tank 3</option>'
        //     + '    </select>'
        // + '          </div>'
        // + '        </div>'
        // + '      </div>'
            
        + tanklist 
        + '      <div class="col-md-3">'
        + '        <div class="row">'
        + '          <div class="col-sm-12">'
        + '           <select class="form-control form-control-sm" name="productname[]">'
        + '             <option value="Gas Oil">Gas Oil</option>'
        + '            </select>'
        // + '            <input type="text" class="form-control form-control-sm" placeholder="Input the Product Name" name="productname[]" required=""/>'
        + '          </div>'
        + '        </div>'
        + '      </div>'



        + '      <div class="col-md-2">'
        + '        <div class="row">'
        + '          <div class="col-sm-12">'
        + '            <input type="text" class="form-control form-control-sm" placeholder="" name="mt[]" required=""/>'
        + '          </div>'
        + '        </div>'
        + '      </div>'

        + '      <div class="col-md-2">'
        + '        <div class="row">'
        + '          <div class="col-sm-12">'
        + '            <input type="text" class="form-control form-control-sm" placeholder="" name="bbl[]" required=""/>'
        + '          </div>'
        + '        </div>'
        + '      </div>'

        + '      <div class="col-md-2">'
        + '        <div class="row">'
        + '          <div class="col-sm-12">'
        + '            <a id="remove_' + id + '" class="remove">'
        + '              <i class="mdi mdi-delete" style="font-size: 20px; color: red;"></i>'
        + '            </a>'
        + '          </div>'
        + '        </div>'
        + '      </div>'
        + '    </div>';
  }

  function getUploadRow(data,user) {
    if (data.remark == null)
        data.remark = '';
    var newRow = '<div class="row"> '
        + '      <div class="col-md-3">'
        + '        <div class="form-group">'
        + '          <a href="../upload_file/' + data.title + '" target="_blank">' + data.title +'</a>'
        + '        </div>'
        + '      </div>'
        + '      <div class="col-md-3">'
        + '        <div class="form-group">'
        + '          '+ data.uploadby 
        + '        </div>'
        + '      </div>'

        + '      <div class="col-md-3">'
            + '      <div class="form-group">'
            + '      <input type="hidden" name="fileid[]" value="'+ data.id +'">'
            + '      <input type="text" class="form-control form-control-sm" name="file_remark[]" value="' + data.remark +'">'
            + '      </div>'
        + '      </div>'

        + '      <div class="col-md-2">'
        + '        <div class="form-group">'
        + '          ' + data.createdate
        + '        </div>'
        + '      </div>'
        + '      <div class="col-md-1">'
        + '        <div class="form-group">';
        if (data.uploadby==user) {
            newRow += '          <a href="javascript:removeFile(' + data.id + ')">Delete</a>';
        }

    newRow += '        </div>'
        + '      </div>'
        + '    </div>';
      return newRow;
  }