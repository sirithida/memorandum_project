<html>
  <head>
<!--style approve form -->
<style>
    header {
      position: relative;
      margin: 10px 0 25px 0;
      font-size: 1.5em;
      text-align: center;
      letter-spacing: 7px;
    }
</style>
<!--end style approve form -->

<div class="clearfix"></div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>NIGHTSHIFT FORM</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>

          <div class="x_content">
          <?php echo form_open("memo_controller/report_email_controller/update_status", array("id"=>"submit" ,"class"=>"form-horizontal form-label-left")) ?>
          <?php $i = 0; ?>
            <table class="table table-bordered" style="Width:90%" align="center">
              <tr>
                <td>MEMO NO : <?php echo $report->row()->hr_memo_no ?></td>
                <td></td>
              </tr>

              <tr>
                <td>START OF DAY : <?php echo  $report->row()->start_datetime ?> </td>
                <td>END OF DAY : <?php echo  $report->row()->end_datetime ?></td>
              </tr>

              <tr>
                <td>SUBJECT : <?php echo  $report->row()->form_subject ?></td>
                <td>SECTION : <?php echo  $report->row()->form_section ?></td>
              </tr>

              <tr>
                <td>FORM : <?php echo  $report->row()->create_by ?></td>
                <td>

                </td>
                <!-- <td>TO : <?php echo  $report->row()->email_address ?></td> -->
              </tr>
            </table>

            <table class="table table-bordered" style="width:90%" align="center">
              <thead>
              </thead>
              <tbody>
                    <tr>
                      <th> No.</th>
                      <th> Employee ID </th>
                      <th> Name</th>
                      <th> Surname </th>
                      <th> Description </th>
                    </tr>

                  <?php foreach ($report->result() as $key => $value): ?>
                    <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $value->personal_id ?></td>
                      <td><?php echo $value->personal_name ?></td>
                      <td><?php echo $value->personal_lastname ?></td>
                      <td><?php echo $value->pic_job_desc ?></td>
                  <?php endforeach; ?>
              </tbody>
            </table>

            <!-- Table approve -->
            </br>
            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="form-group">
                  <div class="col-md-12 col-sm-9 col-xs-12">
                    <header>APPROVE FORM</header>
                    <table class="table table-bordered" style="width:30%" align="center">
                      <tr>
                        <td>
                          <div class="form-group">
                            <label class="control-label col-md-5 col-sm-3 col-xs-12"></label>
                            <div class="col-md-12 col-sm-9 col-xs-12"></div>
                            <div style="text-align:center;"> <?php echo $query_position->row()->position_name ?></div>
                          </div>
                        <input type="hidden" name="form_id" value="<?php echo $query_position->row()->form_id ?>" >
                        <input type="hidden" name="position_id" value="<?php echo $query_position->row()->position_id ?>" >
                        </td>
                      </tr>
                      <tr>
                        <td>
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-3 col-xs-12"></label>
                          <div class="col-md-12 col-sm-9 col-xs-12"></div>
                          <div style="text-align:center;">
                            <?php foreach ($approve_name -> result() as $key => $value): ?>
                              <?php echo $value->personal_name ?>
                            <?php endforeach; ?>

                          </div>
                        </div>
                      <input type="hidden" name="approve_id" value="<?php echo $approve_name->row()->personal_id ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group" align="center">
                          <label class="control-label col-md-5 col-sm-3 col-xs-12"></label>
                          <div class="col-md-12 col-sm-9 col-xs-12"></div>
                          <select name="status_approve">
                              <?php foreach ($status as $row => $value): ?>
                                <option value="<?php echo $row;?>"> <?php echo $value ?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </td>
                    </tr>

                  </table>
                  <div class="form-group" align="center">
                      <input type="hidden" value="<?php echo date("Y-m-d,H:i:s") ?>" name="timestamp"/>
                  </div>
                  <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                  </div>
              </div>
              </div>
            </div>
            </div>


          <!-- Selector form -->
                </br>
                  <div class="form-group" align="center">
                      <button type="btn_submit" type="button" id="submit" class="btn btn-success">Submit</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="button" class="btn btn-danger">Cancel</button>
                      <input type="text" value="<?php echo $id ?>" name="id" hidden>
                  </div>

                  <?php echo form_close() ?>
                  </div>




        </div>
      </div>
    </div>
  </div>
</head>
</html>
