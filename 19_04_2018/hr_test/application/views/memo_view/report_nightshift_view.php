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

    <div class="col-md-9 col-md-offset-1 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>NIGHTSHIFT FORM</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>

          <div class="x_content">
          </br>
          <form id="form_input" <?php echo form_open_multipart("memo_controller/report_nightshift_controller/update_approveid", array("id"=>"submit","class"=>"form-horizontal form-label-left")); ?>

            <?php $i = 0; ?>
              <?php foreach ($nightshift->result() as $key => $value): ?>
              <table class="table table-bordered" style="width:90%" align="center">

                <thead>
                </thead>
                <tbody>
                    <h>พนักงานคนที่ <?php echo ++$i; ?></h>

                <tr>
                  <td>MEMO NO : <?php echo $value->night_no ?></td>
                  <td></td>
                </tr>

                <tr>
                  <td>START OF DAY : <?php echo $value->night_start ?> </td>
                  <td>END OF DAY : <?php echo $value->night_end ?></td>
                </tr>

                <tr>

                  <td>SECTION : <?php echo $value->sec_name ?></td>
                  <td>

                  </td>
                </tr>

                <tr>
                  <td>FORM :<?php echo $value->night_user." ".$value->night_lastname ?> </td>
                  <td>TO : <?php echo $value->personal_name." ".$value->personal_lastname ?> </td>
                </tr>

                <tr>
                  <td>EMPLOYEE ID : <?php echo $value->night_personal ?></td>
                  <td></td>
                </tr>

                <tr>
                  <td>NAME : <?php echo $value->night_user ?></td>
                  <td>SURNAME :  <?php echo $value->night_lastname ?></td>
                </tr>

                <tr>
                  <td>DESCRIPTION :  <?php echo $value->night_operate ?></td>
                  <th></th>
                </tr>
                </tbody>
              </table>
                <?php endforeach; ?>

              <!-- Table approve -->
              </br>
              <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <div class="col-md-12 col-sm-9 col-xs-12">
                      <header>APPROVE FORM</header>
                      <table border="1" cellspacing="4" width="150" height="100" align="center">
                        <tr>
                          <td>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                              <div class="col-md-12 col-sm-9 col-xs-12"></div>
                              <div style="text-align:center;">HOS APPROVE</div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                            <div class="col-md-12 col-sm-9 col-xs-12"></div>
                            <div style="text-align:center;">
                              <?= $approve_hos->row()->personal_name ?>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-group" align="center">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
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
                  </br>
                </div>
                </div>
              </div>
              </div>



            </br>
              <div class="form-group">
                <div class="col-md-12 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="btn_submit" type="button" id="submit" class="btn btn-success">Submit</button>
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
</head>
</html>
