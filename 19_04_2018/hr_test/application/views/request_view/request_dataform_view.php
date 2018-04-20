<!-- หัวข้อ Memorandum -->
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Memorandum systems</h3>
    </div>

    </div>
  </div>

<!-- Memorandum form -->
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Memorandum Form <small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <!-- input new subject -->
        <div class="x_content">
          <br />
          <form class="form-horizontal form-label-left input_mask" <?php echo form_open_multipart("request_controller/request_dataform_controller/insert_type", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12 has-feedback">Add type form : </label>
              <div class="col-md-4 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="new_type" value="<?php echo ((isset($row_edit)) && $row_edit->row()->type_name) ? $row_edit->row()->type_name : "" ; ?>" >
              </div>
            </div>
                <input type="hidden" class="form-control" name="test_type" value="<?php echo ((isset($row_edit)) && $row_edit->row()->type_id) ? $row_edit->row()->type_id : "" ; ?>" >
            <!-- Button -->
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" id="submit_newtype">Submit</button>
                <button class="btn btn-primary" type="reset" name="reset">Reset</button>
                <a onclick='return btn_cancel()' class='btn btn-danger btn_cancel' href="<?php echo site_url('request_controller/request_dataform_controller'); ?>">Cancel</a>
              </div>
            </div>
          </form>
        </div>

  <!--Datatable -->
  <div class="clearfix"></div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
              </div>
              <div class="x_content">
                  <br />
                  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Type form</th>
                            <th>Update / Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($datatable->result() as $row_num => $row) {
                            echo "<tr>
                                <td>".($row_num+1)."</td>
                                <td>".$row->type_name."</td>
                                <td>
                                <a class='btn btn-primary' href=".site_url("request_controller/request_dataform_controller/update_type?v_update_sub=".$row->type_id).">EDIT</a>
                                <a onclick='return btn_delete()' name='btn_delete' class='btn btn-danger btn_delete' href='".site_url("request_controller/request_dataform_controller/del_type?v_btn_del=".$row->type_id)."')'>DELETE</a>
                                </td>
                              </tr>";
                        }
                        ?>
                    </tbody>
                  </table>
              </div>
          </div>
      </div>
  </>
</div>
<!--script-->
<script>
function btn_delete(){
  var rs = confirm("Are you confirm Delete");
  if(!rs){
    return false
  }
}

  function btn_cancel() {
    if (!confirm("Are you confirm delete?")==FALSE) {
    }
  }

  $(document).ready(function() {
    $('#datatable').DataTable();
} );

</script>
