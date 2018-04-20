<!DOCTYPE html>
<html lang="en">
  <head>
    <body>
      <!-- <?php echo $this->session->position_id; ?> -->
      <?php if ($this->session->position_id != 0){ ?>
      <div>
          <?php if ($subject_link){ ?>
            <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> MEMORANDUM APPROVE // กล่องจดหมาย </h2>
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
                  <ul class="list-unstyled msg_list">
                  <?php foreach ($subject_link->result() as $key => $value) {   ?>
                    <li>
                      <a href="<?php echo site_url('memo_controller/report_email_controller/index?subject='.$value->form_id.'&position='.$value->position_id.'&approve_id='.$value->app_form_id);?>"</a>
                        <span>เลขใบที่ : <?php echo $value->hr_memo_no ?></span><br />
                        <span>ชื่อเรื่อง : <?php echo $value->form_subject;  ?></span><br />
                        <span>จาก : <?php echo $value->create_by;  ?>  </span>
                    </li>
                  <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          <?php } ?>
         <?php $hr_listapprove = $this->config->item('hr_listapprove');  ?>
            <?php if ($hr_listapprove == $this->session->personal_id): ?>
                  <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2> HR MEMORANDUM RECEIVE // กล่องจดหมายถึงฝ่ายบุคคล </h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                              <ul class="dropdown-menu" role="menu"></ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div class="x_content">
                          <ul class="list-unstyled msg_list">
                              <?php foreach ($form_statushr->result() as $key => $value): ?>
                              <li>
                                <a href="<?php echo site_url('memo_controller/report_mmhr_controller/index?subject='.$value->form_id);?>"</a>
                                  <span>เลขใบที่ : <?php echo $value->hr_memo_no ?></span><br />
                                  <span>ชื่อเรื่อง : <?php echo $value->form_subject;  ?></span><br />
                                  <span>จาก : <?php echo $value->create_by;  ?>  </span>
                              </li>
                              <?php endforeach; ?>
                          </ul>
                        </div>
                    </div>
                  </div>
            <?php endif; ?>
          </div>

        <?php }; ?>
    </body>
  </head>
</html>




<!-- NIGHTSHIFT
      <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> NIGHTSHIFT APPROVE </h2>
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
            <ul class="list-unstyled msg_list">
            <?php foreach ($nightshift->result() as $key => $value) {   ?>
              <li>
                 <a href="<?php echo site_url('memo_controller/report_nightshift_controller/index?subject='.$value->night_id);?>"</a>
                  <span>
                    <span> <?php echo $value->night_user?> </span>
                    <span class="time"> <?php echo $value->night_start?> </span>
                  </span>
                  <span class="message"><?php echo $value->night_operate?></span>
                </a>
              </li>
            <?php } ?>
            </ul>
        </div>
      </div>
    </div>

  -->
  <!-- End To do list approval -->
