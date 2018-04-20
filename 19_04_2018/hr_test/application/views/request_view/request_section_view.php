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
                    <h2> SECTION REQUEST FORM // แบบฟอร์มเพิ่มหน่วยงาน </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu"></ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br/>

                      <?php echo form_open("request_controller/request_section_controller/insert_sec", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12 has-feedback">Depart part : </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                                <select class="select2_group form-control" name="depart_part">
                                    <optgroup label="Depart part">
                                        <?php
                                        foreach($gen_sec->result() as $row_num => $row){
                                            echo "<option value='".$row->depart_id."'>".$row->depart_name."</option>";
                                        }
                                        ?>

                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12 has-feedback">Sec no : </label>
                          <div class="col-md-5 col-sm-9 col-xs-12">
                          <input type ="text" class="form-control" name="sec_id" maxlength="3" value="<?php echo (isset($row_edit) && $row_edit->row()->sec_id) ? $row_edit->row()->sec_id : NULL; ?>" <?php echo (isset($row_edit) && $row_edit->row()->sec_id) ? "readonly" : "" ; ?> placeholder="input add section_no ">
                        </div>
                            <div>
                              <input type ="hidden" class="form-control" name="hidden_tb" maxlength="3" value="<?php echo (isset($row_edit) && $row_edit->row()->sec_id) ? $row_edit->row()->sec_id : NULL; ?>" <?php echo (isset($row_edit) && $row_edit->row()->sec_id) ? "readonly" : "" ; ?> placeholder="input add section_no ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-3 col-xs-12 has-feedback">Section : </label>
                              <div class="col-md-5 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control" name="sec_name" value="<?php echo (isset($row_edit) && $row_edit->row()->sec_id) ? $row_edit->row()->sec_name : NULL; ?>">
                              </div>
                          </div>

                </div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                        <button type="submit" class="btn btn-success" name="submit_sec">Submit</button>
                        <button class="btn btn-primary" type="reset" name="reset">Reset</button>
                        <a onclick="return btn_cancel();" class="btn btn-danger" href="<?php echo site_url("request_controller/request_section_controller");?>">Cancel</a>
                    </div>
                </div>

              <?php echo form_close() ?>
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
                            <th>Section id</th>
                            <th>Section name</th>
                            <th>Depart name</th>
                            <th>Update / Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data_table->result() as $row_num => $row) {
                            echo "<tr>
                        <td>".($row_num+1)."</td>
                        <td>".$row->sec_id."</td>
                        <td>".$row->sec_name."</td>
                        <td>".$row->depart_name."</td>
                        <td>
                        <a class='btn btn-primary' name='edit_sec' href='".site_url("request_controller/request_section_controller/update_sec?v_update_sec=".$row->sec_id)."'>EDIT</a>
                        <a onclick='return btn_delete()' name='btn_delete' class='btn btn-danger btn_delete' href='".site_url("request_controller/request_section_controller/del_sec?v_sec_id=".$row->sec_id)."')'>DELETE</a>
                        </td>
                      </tr>";
                        }
                        ?>
                        <div>
                      </div>
                </div>
                </tbody>
                </table>
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
