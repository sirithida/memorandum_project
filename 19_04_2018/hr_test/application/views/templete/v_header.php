<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url("build/images/Bubbles-105110.jpg");?>" alt="">
            <?php echo $this->session->username." "."(".$this->session->sec_name.")"." ".$this->session->position_name;?>

            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li align="Center">Choose section </li>

           <?php foreach ($sec_session->result() as $key => $value): ?>
              <li><a href="<?php echo site_url('memo_controller/center/change_sec?sec_id='.$value->sec_id."&sec_name=".$value->sec_name."&id_position=".$value->position_id."&position_name=".$value->position_name);?>"><?php echo $value->sec_name." "."(".$value->position_name.")" ?></a></li>
            <?php endforeach; ?>

            <li><a href="<?php echo site_url("form_controller/logout");?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>


        <?php if ($this->session->position_id != 0){ ?>
        <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-green">
                <?php if ($this->session->personal_id == $list_show->row()->personal_id): ?>
                  <?php echo "มีข้อความที่ยังไม่ได้อ่าน" ?>
                <?php endif; ?>
              </span>
            </a>
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" >
              <li>
                <div class="text-center">
                  <a>
                    <strong><a href="<?php echo site_url('memo_controller/list_approve_controller');?>">See All Alerts</a></strong>
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <?php }; ?>

    </nav>
  </div>
</div>
