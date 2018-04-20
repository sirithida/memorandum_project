<script>
  $(document).ready(function() {
    $(".js-example-basic-multiple").select2();

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
});
</script>

<div class="">
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                    <h2> EMPLOYEE REQUEST FORM // แบบฟอร์มเพิ่มรายชื่อพนักงาน </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                  <div class="clearfix"></div>
              </div>
                <div class="x_content">
                <br/>
                <?php echo form_open_multipart("request_controller/request_employee_controller/insert_emp", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">Employee ID : </label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <input type ="text" class="form-control" name="emp_id" maxlength="6" value="<?php echo (isset($row_edit) && $row_edit->row()->pic_personal_id) ? $row_edit->row()->pic_personal_id : NULL; ?>" placeholder="Input add ID">
                          </div>
                        </div>

                        <!-- hidden update-->
                        <div class="form-group">
                            <div class="col-md-4 col-sm-9 col-xs-12">
                        <input type ="hidden" class="form-control" name="update_emp_id" value="<?php echo (isset($row_edit) && $row_edit->row()->pic_personal_id) ? $row_edit->row()->pic_personal_id : NULL; ?>" placeholder="hidden ID ">

                            </div>
                        </div>
                        <!--------------------------->

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback"> Name : </label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <input type ="text" class="form-control" name="emp_name"  maxlength="20" value="<?php echo (isset($row_edit) && $row_edit->row()->pic_personal_name) ? $row_edit->row()->pic_personal_name : NULL; ?>" <?php echo (isset($row_edit) && $row_edit->row()->pic_personal_name) ?  : "" ; ?> placeholder="input add Name ">
                          </div>
                            <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback"> Lastname : </label>
                          <div class="col-md-4 col-sm-9 col-xs-12">
                            <input type ="text" class="form-control" name="emp_lastname" maxlength="20" value="<?php echo (isset($row_edit) && $row_edit->row()->pic_personal_lastname) ? $row_edit->row()->pic_personal_lastname : NULL; ?>" <?php echo (isset($row_edit) && $row_edit->row()->pic_personal_lastname) ?  : "" ; ?> placeholder="input add Lastname ">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">EMAIL:  </label>
                            <div class="col-md-5 col-sm-9 col-xs-12">
                              <input type ="text" class="form-control" name="emp_email" value="<?php echo (isset($row_edit) && $row_edit->row()->personal_email) ? $row_edit->row()->personal_email : NULL; ?>" <?php echo (isset($row_edit) && $row_edit->row()->personal_email) ?  : "" ; ?> placeholder="input add email ">
                            </div>
                        </div>

                        <label class="control-label col-md-2 col-sm-4 col-xs-12 has-feedback">SECTION </label>
                        <div class="col-md- col-sm-9 col-xs-12">
                          <select class="js-example-basic-multiple form-control" name="emp_sec[]"  id="emp_section" multiple="multiple">
                            <optgroup label="">
                              <?php
                              foreach ($section_select->result() as $row_num => $row) {
                                if (isset($row_edit)) {
                                  foreach ($row_edit->result() as $key => $value) {
                                    if ($row->sec_id."-".$row->position_id == $value->sec_id."-".$value->position_id ) {
                                      echo "<option value=".$row->sec_id."-".$row->position_id." selected>".$value->sec_name."-".$value->position_name."</option>";
                                    }
                                  }

                                }
                                  echo "<option value=".$row->sec_id."-".$row->position_id.">".$row->sec_name."-".$row->position_name."</option>";
                              }
                              ?>
                            </option>
                          </select>
                        </div>


              <!-- Button Submit -->
                </div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-4">
                        <button type="submit" class="btn btn-success" name="submit_emp" href="<?php echo site_url("request_controller/request_employee_controller/insert_del");?>">Submit</button>
                        <button class="btn btn-primary" type="reset" name="reset">Reset</button>
                        <a onclick="return btn_cancel();" class="btn btn-danger" href="<?php echo site_url("request_controller/request_employee_controller");?>">Cancel</a>
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
                            <th> No.</th>
                            <th> id</th>
                            <th> Name</th>
                            <th> Lastname</th>
                            <th> Section</th>
                            <th> Position</th>
                            <th> Update / Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($employee->result() as $row_num => $row) {
                            echo "<tr>
                        <td>".($row_num+1)."</td>
                        <td>".$row->pic_personal_id."</td>
                        <td>".$row->pic_personal_name."</td>
                        <td>".$row->pic_personal_lastname."</td>
                        <td>".$row->sec_name."</td>
                        <td>".$row->position_name."</td>
                        <td>
                          <a class='btn btn-primary' href='".site_url("request_controller/request_employee_controller/update_employee?update=".$row->pic_personal_id)."'>EDIT</a>
                          <a onclick='return btn_delete()' class='btn btn-danger btn_delete' href='".site_url("request_controller/request_employee_controller/del_employee?emp_id=".$row->pic_id)."'>DELETE</a>
                        </td>

                      </tr>";
                        }
                        ?>
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
    if (!confirm("Are you confirm delete ?")) {
      return false;
    }
  }

</script>
