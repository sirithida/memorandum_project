<style>
    header {
      position: relative;
      margin: 10px 0 25px 0;
      font-size: 1.5em;
      text-align: center;
      letter-spacing: 7px;
    }
</style>
    <!--javascript input tag multiple-->
<script>
    $(function(){
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

       $('#datatable_status').DataTable();
		});
</script>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>NIGHT SHIFT FORM</h2>
          <table id="datatable_status" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>DOC.NO</th>
                <th>START</th>
                <th>END</th>
                <th>SECTION</th>
                <th>CREATED BY</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $dummy = null;
              foreach ($search->result() as $key => $value): ?>
              <?php if ($dummy != $value->night_no) : ?>
              <?php if ($key != 0): ?>
            </tbody>
          </table>
            <div class="modal-footer">
              <center><a class="btn btn-default" href="<?php echo site_url('memo_controller/pdf_nightshift_controller/index?subject='.$value->night_no); ?>">PREVIEW</a></center>
          </div>
        </div>
    </div>
  </div>
</div>
           <?php endif; ?>
           <tr>
             <td><?php echo $value->night_no ?> </td>
             <td><?php echo $value->night_start ?></td>
             <td><?php echo $value->night_end ?></td>
             <td><?php echo $value->night_sec ?></td>
             <td><?php echo $this->session->username ?></td>
             <td>
               <!-- Button to Open the Modal -->
               <div class="container">
                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#status_modal_<?php echo $key; ?>">Status</button>

               <!-- Modal -->
                 <div class="modal fade" id="status_modal_<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title">Show Process</h4>
                     </div>
                     <div class="modal-body">
                     <table class="table  table-hover general-table">

                      <tr>
                        <thead>
                          <th>Position</th>
                          <th>Status</th>
                          <th>By</th>
                          <th>Approve Date</th>
                          <th>Remark</th>
                        </thead>
                        <tbody>

                        <tr>
                          <td><?php echo $value->position_name ?></td>
                          <td><?php echo "Waiting" ?></td>
                          <td><?php echo $value->personal_name ?> </td>
                          <td>- </td>
                          <td>- </td>
                        </tr>
                      </tr>

                    </div>
                  </div>
                </div>
              </div>
            </div>
           </td>
         </tr>
         <?php endif ?>
        <?php $dummy = $value->night_no;?>
      <?php endforeach; ?>
        </tbody>
      </table>
