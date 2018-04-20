<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo site_url("memo_controller/memorandum_controller");?>" class="site_title"></i> <span> Memo Systems</span></a>
    </div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_info">
        <span>Welcome,</span>
      <span> <?php  echo $this->session->firstname."&nbsp".$this->session->lastname;?></span>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>Memorandum form</h3>
        <!-- Menu tools -->
        <ul class="nav side-menu">
          <!-- Menu Forms -->
          <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo site_url("memo_controller/memorandum_controller");?>">+ Memo Form </a></li>
              <li><a id="checkstatus" href="<?php echo site_url("request_controller/check_status_controller");?>">+ Check Status </a></li>
            </ul>
          </li>

          <!-- <li><a><i class="fa fa-desktop"></i> Status <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo site_url("memo_controller/approve_status_controller");?>">Approve status</a></li>
            </ul>
          </li>
          <!-- Menu Table -->
          <!--
          <li><a><i class="fa fa-table"></i> Report <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="tables.html">Tables</a></li>
              <li><a href="tables_dynamic.html">Table Dynamic</a></li>
            </ul>
          </li>

          <!-- Menu Data Presentation -->
      <!--    <li><a><i class="fa fa-moon-o"></i> Night Shift <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a id="nightshift" href="<?php echo site_url("memo_controller/night_shift_controller");?>">+ Night Shift Form </a></li>
              <li><a id="nightshift_status" href="<?php echo site_url("request_controller/check_ns_controller");?>">+ Night Shift Status </a></li>
            </ul>
          </li> -->
          <li><a><i id="menu" class="fa fa-eyedropper"></i>Request Form <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
            <!--  <li><a id="typeform" href="<?php echo site_url("request_controller/request_dataform_controller");?>">+ Type Form </a></li> -->
              <li><a id="division" href="<?php echo site_url("request_controller/request_division_controller");?>">+ Division </a></li>
              <li><a id="depart" href="<?php echo site_url("request_controller/request_depart_controller");?>">+ Depart </a></li>
              <li><a id="section" href="<?php echo site_url("request_controller/request_section_controller");?>">+ Section </a></li>
              <li><a id="employee" href="<?php echo site_url("request_controller/request_employee_controller");?>">+ Employee (new) </a></li>
            </ul>
          </li>
        </div>

          <!-- Request Form -->





      <!-- Additional Pages -->
      <!--
      <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="e_commerce.html">E-commerce</a></li>
              <li><a href="projects.html">Projects</a></li>
              <li><a href="project_detail.html">Project Detail</a></li>
              <li><a href="contacts.html">Contacts</a></li>
              <li><a href="profile.html">Profile</a></li>
            </ul>
          </li>
        <!-- Additional Extras -->
        <!--
          <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="page_403.html">403 Error</a></li>
              <li><a href="page_404.html">404 Error</a></li>
              <li><a href="page_500.html">500 Error</a></li>
              <li><a href="plain_page.html">Plain Page</a></li>
              <li><a href="login.html">Login Page</a></li>
              <li><a href="pricing_tables.html">Pricing Tables</a></li>
            </ul>
          </li>
          <!-- Multilevel Menu -->
          <!--
          <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="#level1_1">Level One</a>
                <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                    </li>
                    <li><a href="#level2_1">Level Two</a>
                    </li>
                    <li><a href="#level2_2">Level Two</a>
                    </li>
                  </ul>
                </li>
                <li><a href="#level1_2">Level One</a>
                </li>
            </ul>
          </li>
          <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
        </ul>
      </div>
    -->
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
