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
					<h2> Authorized Management : </h2>
			</div>
		</div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2> MEMO STATUS </h2>
          <table id="datatable_status" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>DOC.NO</th>
                    <th>START</th>
                    <th>SECTION</th>
                    <th>CREATED BY</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $dummy = null;
            $keyprint = null;

            foreach ($query_memo->result() as $key => $value): //วนลูป table qyery $query_memo
              if($dummy != $value->hr_memo_no){ // ถ้าตัวแปร $dummy ไม่เท่ากับ value->hr_memo_no
                if($key != 0):  ?>
                              </tbody>
                            </table>
                            <div class="modal-footer">
                              <center><a class="btn btn-default" href="<?php echo site_url('memo_controller/pdf_controller/index?subject='.$keyprint); ?>">PREVIEW</a></center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                endif;

              //////////////////////////////////////////////////////////////
              $keyprint = $value->form_id;
              $dummy = $value->hr_memo_no;
              //echo $keyprint; die;
              ?>
              <tr>
                <td> <?php echo $value->hr_memo_no ?> </td>
                <td> <?php echo $value->form_date ?></td>
                <td> <?php echo $value->form_section ?></td>
                <td> <?php echo $value->create_by ?></td>
                <td>
                  <!-- Button to Open the Modal -->
                  <div class="container">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#status_modal_<?php echo $key; ?>">Status </button> <!-- <?php echo $value->form_id ?> -->

                  <!-- Modal -->
                  <div class="modal fade" id="status_modal_<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Show Process : <?php echo $value->hr_memo_no ?></h4> <!-- <?php echo $value->form_id ?> -->
                      </div>

                      <div class="modal-body">
                        <table class="table table-hover general-table">
                          <thead>
                            <tr>
                              <th>ตำแหน่ง</th>
                              <th>สถานะ</th>
                              <th>โดย</th>
                              <th>สถานะอนุมัติ</th>
                              <th>วันที่และเวลา </th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr>
                              <td> <?php echo $value->position_name;  ?> </td>
                              <td>
                                <?php if ($value->app_form_status == 1 ){
                                  echo "Waiting";
                                }elseif ($value->app_form_status == 2) {
                                  echo "Approve";
                                }elseif ($value->app_form_status == 3) {
                                  echo "Reject";
                                } ?>
                              </td>
                              <td> <?php echo $value->personal_name ?> </td>
                              <td>
                                <?php if ($value->form_status == 1 ){
                                  echo "PASS";
                                }else {
                                  echo "NOPASS";
                                } ?>
                                </td>
                              <td><?php echo $value->approve_time ?></td>

                            </tr>

                    <?php }else{  ?>
                    <tr>
                      <td><?php echo $value->position_name; ?> </td>
                      <td>
                        <?php if ($value->app_form_status == 1 ){
                          echo "Waiting";
                        }elseif ($value->app_form_status == 2) {
                          echo "Approve";
                        }elseif ($value->app_form_status == 3) {
                          echo "Reject";
                        } ?>
                      </td>
                      <td> <?php echo $value->personal_name ?> </td>
                      <td>
                        <?php if ($value->form_status == 1 ){
                          echo "PASS";
                        }else {
                          echo "NOPASS";
                        } ?>
                      </td>
                      <td> <?php echo $value->approve_time ?></td>
                    </tr>
                  <?php
                } ?>
                </td>

            <?php
              if($key+1 == $query_memo->num_rows()):  ?>
                          </tbody>
                        </table>
                        <div class="modal-footer">
                          <center><a class="btn btn-default" href="<?php echo site_url('memo_controller/pdf_controller/index?subject='.$keyprint); ?>">PREVIEW</a></center>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
            endif;
            endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
