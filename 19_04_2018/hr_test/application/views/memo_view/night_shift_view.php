<style>
    header {
      position: relative;
      margin: 10px 0 25px 0;
      font-size: 1.5em;
      text-align: center;
      letter-spacing: 7px;
    }

    .city{
      background-color: tomato;
      color: white;
      padding: 10px;
  }

</style>

    <!--javascript input tag multiple-->
<script>
  $(function(){ // ready
      $('.js-example-basic-multiple').select2();

    	$("#add_div").click(function(){
    		var last_div = $('.div_participate').last();
    		$($('.div_participate').first().clone()).appendTo(last_div);

    	});
      //format DateTimePicker
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

      initAutocomplete();
      //calculateGrandTotal();
      //Dynamic table bootstap
      var counter = 1;

      $("#addrow").on("click", function () {
          var newRow = $("<tr>");
          var cols = "";

          cols +=
            '<td>'+
              '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' + (parseInt(counter) + parseInt(1)) +''+
            '</td>'+
            '<td>'+
              '<div class="form-group">'+
                 '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">EMP ID : </label>'+
                 '<div class="col-md-4 col-sm-9 col-xs-12">'+
                   '<div class="ui-widget">'+
                     '<input type="text" class="form-control ns_autocomplete" data-username="username'+ counter +'" name="night_personal[]" data-lastname="lastname'+ counter +'" id="personal_id'+ counter +'" required >'+
                   '</div>'+
                 '</div>'+
               '</div>'+

            '<div class="form-group">'+
                '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">USERNAME : </label>'+
                '<div class="col-md-4 col-sm-9 col-xs-12">'+
                  '<div class="ui-widget">'+
                  ' <input type="text" class="form-control" name="night_user[]" id="username'+ counter +'" >'+
                  '</div>'+
              ' </div>'+
                '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">LASTNAME : </label>'+
                '<div class="col-md-4 col-sm-9 col-xs-12">'+
                  '<div class="ui-widget">'+
                  '<input type="text" class="form-control" name="night_lastname[]" id="lastname'+ counter +'">'+
                  '</div>'+
                '</div>'+
            '</div>'+


            '<div class="form-group" >'+
              '<label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">BUS : </label>'+
                '<div class="col-md-4 col-sm-9 col-xs-12">'+
                  '<h5><label class="radio-inline"><input type="radio" name="bus'+ counter +'" value="0">ต้องการรถ รับ-ส่ง</label></h4>'+

                  '<h5><label class="radio-inline"><input type="radio" name="bus'+ counter +'" value="1">ไม่ต้องการ</label></h5>'+
                '</div>'+
            '</div>'+
            '</td>';

          cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
          newRow.append(cols);
          $("table.order-list").append(newRow);
          counter++;

          initAutocomplete();
          //calculateGrandTotal();
      });



      function calculateRow(row) {
          var personal = +row.find('input[name^="personal"]').val();
      }

      $("table.order-list").on("click", ".ibtnDel", function () {
          $(this).closest("tr").remove();
          counter -= 1
      });

      function calculateGrandTotal() {
          var grandTotal = 0;
          $("table.order-list tbody").find('tr').each(function () {
              grandTotal += 1;
          });
          $("#grandtotal").text(grandTotal.toFixed(2));
      }
  });

  function initAutocomplete(){
    $(".ns_autocomplete").autocomplete({
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
  }

</script>

<div class="row">
  <h1 id="grandtotal"></h1>
  <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>NIGHT SHIFT FORM // แบบฟอร์มการขอใช้งานเข้ากะกลางคืน <small></small></h2>
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
            <?php echo form_open("memo_controller/night_shift_controller/insert_nightform", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); ?>
              <!--<form id="form_input" class="form-horizontal form-label-left" action="<?php echo site_url("memo_controller/memorandum_controller/insert_form");?>" method="post"> -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12 has-feedback">NIGHT SHIFT NO: </label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <div class="ui-widget">
                    <input type="text" class="form-control" name="ns_no" value="<?php echo $night_no->row()->get_nightshift_no ?>" readonly>
                  </div>
                </div>
              </div>
          </td>
        </tr>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 has-feedback">THE WEEK OF : </label>
          <div class="input-group input-daterange col-md-6 col-sm-9 col-xs-12">
            <input type="text" class="form-control" id="datetime_start" name="start" required>
          <div class="input-group-addon">to</div>
            <input type="text" class="form-control" id="datetime_end" name="end" required>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 has-feedback">SECTION : </label>
            <div class="col-md-3 col-sm-9 col-xs-12">
          <select class="select2_group form-control" name="night_sec" id="night_section" required>
              <?php foreach ($sec_select->result() as $row => $value) {
                  echo "<option value='".$value->sec_id."'>".$value->sec_name."</option>";
              } ?>
          </select>
          </div>
          <label class="control-label col-md-2 col-sm-2 col-xs-12 has-feedback">OPERATION POINT </label>
            <div class="col-md-3 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="night_operate" required>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12 has-feedback">GROUP TYPE : </label>
            <button type="button" class="btn btn-success">GROUP A</button>
            <button type="button" class="btn btn-warning">GROUP B</button>
        </div>
        <br />


        <table id="myTable" class="table table-responsive order-list">
          <thead>
            <tr>
              <th class="center" width="8%"><center>#</center></th>
              <th><center>Detail</center></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 1
            </td>
            <td>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">EMP ID : </label>
                <div class="col-md-4 col-sm-9 col-xs-12">
                  <div class="ui-widget">
                    <input type="text" class="form-control ns_autocomplete" data-username="username0" data-lastname="lastname0" name="night_personal[]" id="personal_id" required >
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">USERNAME : </label>
                <div class="col-md-4 col-sm-9 col-xs-12">
                  <div class="ui-widget">
                    <input type="text" class="form-control" name="night_user[]" id="username0" >
                  </div>
                </div>
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">LASTNAME : </label>
                <div class="col-md-4 col-sm-9 col-xs-12">
                  <div class="ui-widget">
                    <input type="text" class="form-control" name="night_lastname[]" id="lastname0">
                  </div>
                </div>
              </div>
              <div class="form-group" >
                <label class="control-label col-md-2 col-sm-3 col-xs-12 has-feedback">BUS : </label>
                <div class="col-md-4 col-sm-9 col-xs-12" >
                  <h5><label class="radio-inline"><input type="radio" name="bus" value="0">ต้องการรถ รับ-ส่ง</label></h4>
                  <h5><label class="radio-inline"><input type="radio" name="bus" value="1">ไม่ต้องการ</label></h5>
                </div>
              </div>
            </td>
            <td></td>
          </tr>
          </tbody>
        <tfoot>
          <tr>
            <td colspan="3" style="text-align: center;">
              <div class="form-group">
                <div class="col-md-6 col-sm-9 col-xs-12 col-md-offset-3" align="Center">
                  <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Employee" />
                </div>
              </div>
            </td>
          </tr>
        </tfoot>
        </table>

        <header>SEND EMAIL</header>

          <div class="form-group">
            <div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4" align="Center">
                <input type="hidden" name="apr_hos" value="<?php echo $hos_apr->row()->personal_id ?>">
                <input type="text" class="form-control" value="<?php echo $hos_apr->row()->personal_name ?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-3 col-sm-9 col-xs-12">
            <input type="hidden" class="form-control" name="date_approve" value="<?php echo date("Y-m-d")?>">
            </div>
          </div>

          <br />
        <div class="form-group">
          <div class="col-md-6 col-sm-9 col-xs-12 col-md-offset-3" align="Center">
            <input id="btn_submit" type="submit" class="btn btn-success" value="submit">
            <button class="btn btn-primary" type="reset">Reset</button>
            <button type="button" class="btn btn-danger">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
