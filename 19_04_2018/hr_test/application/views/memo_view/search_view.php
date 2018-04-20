<style>
    header {
      position: relative;
      margin: 10px 0 25px 0;
      font-size: 1.5em;
      text-align: center;


      letter-spacing: 7px;
    }
</style>
<script>
    $(function(){
      $('.js-example-basic-multiple').select2();

    	$("#add_div").click(function(){
    		var last_div = $('.div_participate').last();
    		$($('.div_participate').first().clone()).appendTo(last_div); //first() = Jquery,Clone()=jquery คัดลอก element appendTo = การแทรก element ไว้ด้านล่าง

    		$(".reservation-time").daterangepicker({
    			timePicker: !0,
    			timePickerIncrement: 30,
    			locale: {
    				format: "MM/DD/YYYY h:mm A"
    			}
    		});
    	});

    	$(".reservation-time").daterangepicker({
    		timePicker: !0,
    		timePickerIncrement: 30,
    		locale: {
    			format: "MM/DD/YYYY"
    		}
    	});

      function autocomplete2(message1,selector2) {
        $(selector2).val(message1); //$#username = ช่องที่จะเอาไปใส่ select

      }

      $("#personal_id").autocomplete({ // ใส่ตัวแปรช่องที่จะหา Autocomplete
        source: "<?php echo site_url('memo_controller/memorandum_controller/hr_person')?>",
        minLength: 3,
        select: function(event, ui) {
        //  autocomplete2(ui.item.username, "#username")
          $("#username").val(ui.item.username);
          $("#surname").val(ui.item.surname);
        //  autocomplete2(ui.item.surname,"#surname")
        }
      });

      $('#datetime_start').datetimepicker({
        useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
        minDate: moment(),
        format: "YYYY-MM-DD HH:mm:00",
      });

      $("#datetime_start").on("dp.change", function (e) {
          //$('#datetime_start').data("DateTimePicker").minDate(e.date);
      });

      $('#datetime_end').datetimepicker({
        useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
        minDate: moment(),
        format: "YYYY-MM-DD HH:mm:00",
      });

      $("#datetime_end").on("dp.change", function (e) {
          $('#datetime_start').data("DateTimePicker").maxDate(e.date);
      });

    });
</script>
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>MEMORANDUM FORM <small></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
             <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <br/>
          <?php echo form_open_multipart("memo_controller/memorandum_controller/insert_form", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>
            <!--<form id="form_input" class="form-horizontal form-label-left" action="<?php echo site_url("memo_controller/memorandum_controller/insert_form");?>" method="post"> -->
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">MEMO NO: </label>
                <div class="col-md-3 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="memo_no" value="<?php echo $memo_no->row()->get_memo_no ?> " readonly>
                </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">THE WEEK OF : </label>
              <div class="input-group input-daterange col-md-6 col-sm-9 col-xs-12">
                <input type="text" class="form-control" id="datetime_start" name="start">
              <div class="input-group-addon">to</div>
                <input type="text" class="form-control" id="datetime_end" name="end">
              </div>
            </div>

                   <?php foreach ($typeform->result() as $row_num => $row) {
                        echo "<option value ='".$row->type_id."'>".$row->type_name."</option>";
                      }
                      ?>
                  </optgroup>
                </select>
              </div>
            </DIV>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-4 col-xs-12 has-feedback">SUBJECT :</label>
                  <div class="col-md-4 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="user_subject" required>
                  </div>
                  <label class="control-label col-md-1 col-sm-3 col-xs-12 has-feedback">SECTION: </label>
                  <div class="col-md-4 col-sm-9 col-xs-12">
                    <select class="select2_group form-control" name="section_memo">
                        <optgroup label="">
                          <?php foreach ($sec_memo->result() as $row_num => $row) {
                               echo "<option value='".$row->sec_name."'>".$row->sec_name."</option>";
                             }
                             ?>
                        </optgroup>
                    </select>
                  </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">FROM : </label>
              <div class="col-md-4 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="user_from" value="<?php echo $this->session->username;?>" readonly>
              </div>

              <label class="control-label col-md-1 col-sm-4 col-xs-12 has-feedback">TO </label>
              <div class="col-md-4 col-sm-9 col-xs-12">
                <select class="js-example-basic-multiple form-control" name="user_to[]" multiple="multiple" required>
                  <optgroup label="">
                    <?php
                    foreach ($email->result() as $row_num => $row) {
                      echo "<option value ='".$row->personal_name."|".$row->personal_email."|".$row->personal_id."'>".$row->personal_name."&nbsp".$row->personal_lastname.";</option>";
                    }
                    ?>
                  </option>
                </select>
              </div>
            </div>
			      <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">CC : </label>
              <div class="col-md-4 col-sm-9 col-xs-12">
                  <select class="js-example-basic-multiple form-control" name="user_cc[]" multiple="multiple">
                    <optgroup label="">
                    <?php
                    foreach ($email_cc->result() as $row_num => $row) {
                      echo "<option value ='".$row->personal_name."|".$row->personal_email."|".$row->personal_id."'>".$row->personal_name."&nbsp;&#40;".$row->personal_email."&#41;</option>";
                    }
                    ?>
                    </optgroup>
                  </select>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">ATTACH FILE : </label>
                <div class="col-md-3 col-sm-9 col-xs-12">
                <input type="file" name="upload_file" id="upload">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">DESCRIPTION : </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea style="resize:none;" name="user_detail" class="form-control" id="description" required></textarea>
              </div>
            </div>
			      <div class="form-group">
      			<div class="div_participate">
      					<div class="col-md-1 col_id">
      						<div style="text-align:center">
      							1
      						</div>
      					</div>
              </br>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">PERSONAL ID : </label>
              <div class="col-md-3 col-sm-9 col-xs-12">
                <div class="ui-widget">
                  <input type="text" class="form-control" name="user_id" id="personal_id" required>
                </div>
              </div>
            </div>
						<div class="form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">NAME : </label>
						  <div class="col-md-3 col-sm-9 col-xs-12">
							  <input type="text" class="form-control"  name="user_name" id="username" required >
						  </div>

						  <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">SURNAME :</label>
						  <div class="col-md-4 col-sm-9 col-xs-12">
							<input type="text" class="form-control"  name="user_surname" id="surname" required>
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">DESCRIPTION : </label>
						  <div class="col-md-9 col-sm-9 col-xs-12">
							<textarea style="resize:none;" name="comment" class="form-control" required></textarea>
						  </div>
						</div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="radio">
                <label><h4><input type="radio" name="optradio">ต้องการรถรับ-ส่ง</label></h4>
              </div>
              <div class="radio">
                <label><h4><input type="radio" name="optradio">ไม่ต้องการรถรับ-ส่ง</label></h4>
              </div>
              </div>
            </div>

  					<div class="col-md-2" style="text-align:center;">
  						<div style="text-align: center">
  							<a class="btn btn-danger">-</a>
  						</div>
  					</div>
  					<div class="ln_solid"></div>
  					<div class="clearfix"></div>
		        </div>
      			<div class="clearfix"></div>
      			<div class="col-md-1 col-md-offset-11 col-sm-12 col-xs-12">
      				<a class="btn btn-primary" id="add_div">ADD</a>
          	</div>
            </div>
            </div>
            <div class="ln_solid"></div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="form-group">
                  <div class="col-md-12 col-sm-9 col-xs-12">
                    <header>APPROVE FORM</header>
                    <?php
                    $disable_sup = ""; //กำหนดตัวแปรมา 2 ตัว
                    $disable_hos = ""; //กำหนดตัวแปรให้เป็นค่าว่าง เพื่อเก็บ
                    //เขียนเงื่อนไข ถ้า $flow มีค่าแถวแรก และ ค่าแถวแรก =1
                    if ($flow->num_rows() && $flow->row()->position_id== 1):
                      $disable_sup = "disabled"; //ให้ disabled ไว้
                      // แต่ถ้า า $flow มีค่าแถวแรก และ ค่าแถวแรก =2
                    elseif ($flow->num_rows() && $flow->row()->position_id == 2):
                      $disable_sup = "disabled"; //ให้ disabled ไว้
                      $disable_hos = "disabled"; //ให้ disabled ไว้
                    endif;
                    ?>
                    <table border="1" cellspacing="4" width="500" height="100" align="center">
                      <tr>
                        <td><center>SUPERVISOR</center></td>
                        <td><center>HOS</center></td>
                        <td><center>HOD</center></td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                              <select class="select2_group form-control" name="super_approve" <?php echo $disable_sup;?>>
                                <option value="supervisor">
                                  <optgroup label="SUPERVISOR">
                                    <?php foreach ($supervisor->result() as $row_num => $row) {
                                      echo "<option value ='".$row->position_id."|".$row->personal_id."|".$row->personal_email."'>".$row->personal_name."</option>";
                                    }
                                    ?>
                                  </option>
                                </optgroup>
                              </select>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12"></label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                              <select class="select2_group form-control" name="hos_approve" <?php echo $disable_hos;?> >
                                <optgroup label="HOS">
                                   <?php
                                    foreach ($hos->result() as $row_num => $row) {
                                      echo "<option value ='".$row->position_id."|".$row->personal_id."'>".$row->personal_name."</option>";
                                    }
                                    ?>
                                </optgroup>
                              </select>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-12 col-sm-9 col-xs-12">
                              <select class="select2_group form-control" name="hod_approve">
                                <optgroup label="HOD">
                                    <?php
                                    foreach ($hod->result() as $row_num => $row) {
                                      echo "<option value ='".$row->position_id."|".$row->personal_id."'>".$row->personal_name."</option>";
                                    }
                                    ?>
                                </optgroup>
                              </select>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <br/>
                  <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                      <input id="btn_submit" type="submit" class="btn btn-success" value="Submit">
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="button" class="btn btn-primary">Cancel</button>
                    </div>
                  </div>
                </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    	   </div>
       </div>
     </div>
    <div>
