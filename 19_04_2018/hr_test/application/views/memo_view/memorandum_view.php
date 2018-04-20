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


/////////////////////////////////////////////////////////////////////////////////////

      $('.date_start').datetimepicker({
        useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
        minDate: moment(),
        format: "YYYY-MM-DD",
      });

      $("#date_start").on("dp.change", function (e) {
          //$('#datetime_start').data("DateTimePicker").minDate(e.date);
      });

      $('.date_end').datetimepicker({
        useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
        minDate: moment(),
        format: "YYYY-MM-DD",
      });

      $(".date_end").on("dp.change", function (e) {
          $('.date_start').data("DateTimePicker").maxDate(e.date);
      });

      //timeofwork script
    $('.time_start').datetimepicker({
      useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
      minDate: moment(),
      format: "HH:mm:00",
    });

    $(".time_start").on("dp.change", function (e) {
        //$('#datetime_start').data("DateTimePicker").minDate(e.date);
    });

    $('.time_end').datetimepicker({
      useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
      minDate: moment(),
      format: "HH:mm:00",
    });

    $(".time_end").on("dp.change", function (e) {
        $('.time_start').data("DateTimePicker").maxDate(e.date);
    });


      initAutocomplete()
      //Dynamic add row table bootstap
      var counter = 1;
      $("#addrow").on("click", function () {
          var newRow = $("<tr>");
          var cols = "";

          cols +=
            '<div class="ln_solid"></div>'+ <!-- ขีดเส้นใต้ คั้นระหว่าง Form ทั่วไป กับข้อมูลส่วนบุคคล -->
              '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' + (parseInt(counter) + parseInt(1)) +''+
          '<td>'+
          '<div class="form-group">'+
             '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* EMPLOYEE ID : </label>'+
             '<div class="col-md-3 col-sm-9 col-xs-12">'+
               '<div class="ui-widget">'+
                 '<input type="text" class="form-control memo_autocomplete" data-username="username'+ counter +'" data-lastname="surname'+ counter +'" name="user_id[]" id="personal_id'+ counter +'" required>'+
               '</div>'+
             '</div>'+
           '</div>'+

           '<div class="form-group">'+
             '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback"* >NAME : </label>'+
               '<div class="col-md-3 col-sm-9 col-xs-12">'+
                 '<input type="text" class="form-control"  name="user_name[]" id="username'+ counter +'" required >'+
             '</div>'+
               '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* SURNAME :</label>'+
               '<div class="col-md-3 col-sm-9 col-xs-12">'+
                 '<input type="text" class="form-control"  name="user_surname[]" id="surname'+ counter +'" required>'+
               '</div>'+
         '</div>'+

         '<div class="form-group">'+
          ' <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* THE WEEK OF : </label>'+
          ' <div class="input-group input-daterange col-md-4 col-sm-9 col-xs-12">'+
             '<input type="text" class="form-control date_start" id="start_date'+ counter +'" name="date_start[]" required>'+
           '<div class="input-group-addon">to</div>'+
             '<input type="text" class="form-control date_end" id="end_date'+ counter +'" name="date_end[]" required>'+
          '</div>'+
         '</div>'+

         '<div class="form-group">'+
           '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* TIME OF WORK : </label>'+
           '<div class="input-group input-daterange col-md-4 col-sm-9 col-xs-12">'+
            '<input type="text" class="form-control time_start" id="time_start'+ counter +'" name="time_start[]" required>'+
           '<div class="input-group-addon">to</div>'+
             '<input type="text" class="form-control time_end" id="time_end'+ counter +'" name="time_end[]" required>'+
           '</div>'+
        '</div>'+

           '<div class="form-group">'+
             '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">DESCRIPTION : </label>'+
               '<div class="col-md-9 col-sm-9 col-xs-12">'+
                 '<textarea style="resize:none;" name="comment[]" class="form-control" id="job_desc'+ counter +'" required></textarea>'+
               '</div>'+
           '</div>'+

           '<div class="form-group" >'+
             '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">BUS : </label>'+
             '<div class="col-md-4 col-sm-9 col-xs-12" >'+
               '<h5><label class="radio-inline"><input type="radio"  name="bus[]'+ counter +'" value="0">ต้องการรถ รับ-ส่ง</label></h4>'+
               '<h5><label class="radio-inline"><input type="radio"  name="bus[]'+ counter +'" value="1">ไม่ต้องการ</label></h5>'+
             '</div>'+
          ' </div>'+
          '</td>';

          cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger pull-right" value="Delete"></td>';
          newRow.append(cols);
          $("table.order-list").append(newRow);
          counter++;

          initAutocomplete();
      });

      $("table.order-list").on("click", ".ibtnDel", function (event) {
          $(this).closest("tr").remove();
          counter -= 1
      });

      function initAutocomplete(){
        $(".memo_autocomplete").autocomplete({
          source: "<?php echo site_url('memo_controller/memorandum_controller/hr_person')?>",
          minLength: 3,
          select: function( event, ui ) {
              var auto_name = $(this).data("username");
              var auto_lastname = $(this).data("lastname");
              //alert(auto_name + ":" + auto_lastname);
              $("#"+auto_name).val(ui.item.username);
              $("#"+auto_lastname).val(ui.item.surname);
          }
        });

        //datepicker ทำต่อจาก autocompelete ในส่วนที่ addrow
        $('.date_start').datetimepicker({
          useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
          minDate: moment(),
          format: "YYYY-MM-DD",
        });

        $("#date_start").on("dp.change", function (e) {
            //$('#datetime_start').data("DateTimePicker").minDate(e.date);
        });

        $('.date_end').datetimepicker({
          useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
          minDate: moment(),
          format: "YYYY-MM-DD",
        });

        $(".date_end").on("dp.change", function (e) {
            $('.date_start').data("DateTimePicker").maxDate(e.date);
        });

          //timeofwork script
        $('.time_start').datetimepicker({
          useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
          minDate: moment(),
          format: "HH:mm:00",
        });

        $(".time_start").on("dp.change", function (e) {
            //$('#datetime_start').data("DateTimePicker").minDate(e.date);
        });

        $('.time_end').datetimepicker({
          useCurrent: true, //เห็น วันที่ ตอนสั่งกดเปิดปฎิทิน
          minDate: moment(),
          format: "HH:mm:00",
        });

        $(".time_end").on("dp.change", function (e) {
            $('.time_start').data("DateTimePicker").maxDate(e.date);
        });
      }
    });
</script>

<div class="row">
  <h1 id="grandtotal"></h1>
  <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>MEMORANDUM FORM // แบบฟอร์มการขอใช้งาน Memo <small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        <tr>
          <td>
            <?php echo form_open("memo_controller/memorandum_controller/insert_form", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>
              <!--<form id="form_input" class="form-horizontal form-label-left" action="<?php echo site_url("memo_controller/memorandum_controller/insert_form");?>" method="post"> -->
              <div class="form-group" align="center">
                  <input type="hidden" value="<?php echo date("Y-m-d,H:i:s") ?>" name="timestamp"/>
              </div>

              <label> ข้อมูลทั่วไป </label>
              <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">MEMO NO: </label>
                  <div class="col-md-3 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="memo_no" value="<?php echo $memo_no->row()->get_memo_no ?>" readonly>
                  </div>
              </div>

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

                <label class="control-label col-md-1 col-sm-4 col-xs-12 has-feedback">TO : </label>
                <div class="col-md-4 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="to_hr" value="HR,GA SECTION" readonly>
                </div>
              </div>



              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">CC : </label>
                <div class="col-md-5 col-sm-9 col-xs-12">
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

              <div class="ln_solid"></div> <!-- ขีดเส้นใต้ คั้นระหว่าง Form ทั่วไป กับข้อมูลส่วนบุคคล -->
                <div class="container">
                  <table id="myTable" class=" table order-list">
                  <thead>
                      <tr>

                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 1 <a> สามารถเพิ่มได้เฉพาะคนในแผนกที่เลือกเท่านั้น </a>
                          <td> </td>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td class="col-sm-12">
                            <div class="form-group">
                               <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* EMPLOYEE ID : </label>
                               <div class="col-md-3 col-sm-9 col-xs-12">
                                 <div class="ui-widget">
                                   <input type="text" class="form-control memo_autocomplete" data-username="username0" data-lastname="surname0" name="user_id[]" id="personal_id" required>
                                 </div>
                               </div>
                             </div>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* NAME : </label>
                                <div class="col-md-3 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control"  name="user_name[]" id="username0" required >
                                </div>
                                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* SURNAME :</label>
                                <div class="col-md-3 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control"  name="user_surname[]" id="surname0" required>
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* DATE OF WORK:</label>
                              <div class="input-group input-daterange col-md-4 col-sm-9 col-xs-12">
                                <input type="text" class="form-control date_start" id="start_date" name="date_start[]" required>
                              <div class="input-group-addon">to</div>
                                <input type="text" class="form-control date_end" id="end_date" name="date_end[]" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">* TIME OF WORK : </label>
                              <div class="input-group input-daterange col-md-4 col-sm-9 col-xs-12">
                                <input type="text" class="form-control time_start" id="time_start" name="time_start[]" required>
                              <div class="input-group-addon">to</div>
                                <input type="text" class="form-control time_end" id="time_end" name="time_end[]" required>
                              </div>
                            </div>


                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">DESCRIPTION : </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                  <textarea style="resize:none;" name="comment[]" id="comment0" class="form-control" required></textarea>
                                </div>
                            </div>

                            <!-- ข้อมูลรถรับส่ง -->
                            <div class="form-group" >
                              <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">BUS : </label>
                                <div class="col-md-4 col-sm-9 col-xs-12" >
                                  <h5><label class="radio-inline"><input type="radio" name="bus[]" value="0">ต้องการรถ รับ-ส่ง</label></h4>

                                  <h5><label class="radio-inline"><input type="radio" name="bus[]" value="1">ไม่ต้องการ</label></h5>
                                </div>
                            </div>
                          </td>

                          <td class="col-sm-2"><a class="deleteRow"></a></td>
                      </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="5" style="text-align: left;">
                              <input type="button" class="btn btn-md btn-block " id="addrow" value="Add Row" />
                          </td>
                      </tr>
                      <tr>
                      </tr>
                  </tfoot>
                </table>
              </div>



              <div class="ln_solid"></div> <!-- ขีดเส้นใต้ คั้นระหว่าง Form ทั่วไป กับข้อมูลส่วนบุคคล -->
              <!-- table Approve -->
              <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <div class="col-md-12 col-sm-9 col-xs-12">
                      <header>APPROVE FORM</header>
                      <?php
                      $disable_sup = ""; //กำหนดตัวแปรมา 2 ตัว
                      $disable_hos = ""; //กำหนดตัวแปรให้เป็นค่าว่าง เพื่อเก็บ
                      //เขียนเงื่อนไข ถ้า $flow มีค่าแถวแรก และ ค่าแถวแรก =1
                      if ($flow->num_rows() && $flow->row()->pic_position_id== 1):
                        $disable_sup = "disabled"; //ให้ disabled ไว้
                        // แต่ถ้า า $flow มีค่าแถวแรก และ ค่าแถวแรก =2
                      elseif ($flow->num_rows() && $flow->row()->pic_position_id == 2):
                        $disable_sup = "disabled"; //ให้ disabled ไว้
                        $disable_hos = "disabled"; //ให้ disabled ไว้
                      elseif ($flow->num_rows() && $flow->row()->pic_position_id == 3):
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
                                    <optgroup label="">
                                        <?php foreach ($supervisor->result() as $row_num => $row) {
                                          if ($supervisor->row()->pic_position_id == $this->session->position_id) {
                                            echo "<option value ='".$row->pic_position_id."|".$row->pic_personal_id."'>".$flow->row()->pic_personal_name."</option>";
                                          }else {
                                            echo "<option value ='".$row->pic_position_id."|".$row->pic_personal_id."'>".$row->pic_personal_name."</option>";
                                          }
                                        }
                                      ?>
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
                                  <optgroup label="">
                                     <?php foreach ($hos->result() as $row_num => $row) {
                                       if ($hos->row()->pic_position_id == $this->session->position_id) {
                                         echo "<option value ='".$row->pic_position_id."|".$row->pic_personal_id."'>".$flow->row()->pic_personal_name."</option>";
                                       }else {
                                         echo "<option value ='".$row->pic_position_id."|".$row->pic_personal_id."'>".$row->pic_personal_name."</option>";
                                       }
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
                                  <optgroup label="">
                                      <?php
                                      foreach ($hod->result() as $row_num => $row) {
                                        echo "<option value ='".$row->pic_position_id."|".$row->pic_personal_id."'>".$row->pic_personal_name."</option>";
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
                        <button type="button" class="btn btn-danger">Cancel</button>
                      </div>
                    </div>
                  </form>


                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        </td>
      </tr>
  </div>
</div>
