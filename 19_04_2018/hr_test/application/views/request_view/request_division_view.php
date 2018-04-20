<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Memorandum systems</h3>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="row">

    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2> DIVISION REQUEST FORM // แบบฟอร์มเพิ่มฝ่าย </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">

              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <br />
            <form class="form-horizontal form-label-left input_mask" <?php echo form_open_multipart("request_controller/request_division_controller/insert_divis", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-3 col-xs-12 has-feedback">Division : </label>
              <div class="col-md-5 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="div_name" value="<?php echo ((isset($row_edit)) && $row_edit->row()->div_name) ? $row_edit->row()->div_name : NULL ; ?>" placeholder="div_name">
              </div>
            </div>
            <input type="hidden" class="form-control" name="div_id" value="<?php echo ((isset($row_edit)) && $row_edit->row()->div_id) ? $row_edit->row()->div_id : NULL ; ?>" placeholder="div_id">
          </div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success" id="submit_divis">Submit</button>
                <button type="reset"  class="btn btn-primary" name="reset">Reset</button>
                <a onclick='return btn_cancel()' name="btn_delete" class='btn btn-danger btn_cencel' href="<?php echo site_url('request_controller/request_division_controller');?>">Cancel</a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
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
                  <th>Division name</th>
                  <th>Update / Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data_table->result() as $row_num => $row) :
                  echo "<tr>
                          <td>".($row_num+1)."</td>
                          <td>".$row->div_name."</td>
                          <td>
                            <a class='btn btn-primary' href='".site_url("request_controller/request_division_controller/update_divis?v_update_divis=".$row->div_id)."'>EDIT</a>
                            <a onclick='return btn_delete()' class='btn btn-danger btn_delete' href='".site_url("request_controller/request_division_controller/del_divis?v_divis_id=".$row->div_id)."'>DELETE</a>
                          </td>
                        </tr>";
                endforeach;
                ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  function btn_delete(){
    var rs = confirm("Are you confirm Delete");
    if(!rs){
      return false
    }
  }


    function btn_cancel() {
      if(!confirm("Are you confirm delete ?")){
      return false;
    }
  }
  </script>
</div>
