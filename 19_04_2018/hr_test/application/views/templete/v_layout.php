<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Memo System</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url("vendors/bootstrap/dist/css/bootstrap.min.css");?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url("vendors/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url("vendors/nprogress/nprogress.css");?>" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.css");?>" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url("vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css");?>" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="<?php echo base_url("vendors/normalize-css/normalize.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("vendors/ion.rangeSlider/css/ion.rangeSlider.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css");?>" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="<?php echo base_url("vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css");?>" rel="stylesheet">

    <link href="<?php echo base_url("vendors/cropper/dist/cropper.min.css");?>" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url("vendors/datatables.net-bs/css/dataTables.bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url("build/css/custom.min.css");?>" rel="stylesheet">

  	 <!-- Select2 -->
  	<link href="<?php echo base_url("vendors/select2/dist/css/select2.min.css");?>" rel="stylesheet">
	   <!-- autocomplete -->
    <link  href="<?php echo base_url("vendors/jquery/src/jquery-ui.css");?>" rel="stylesheet">
    <!--Datepicker -->
    <link  href="<?php echo base_url("vendors/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.css");?>" rel="stylesheet">
    <!--select master -->
    <link  href="<?php echo base_url("vendors/bootstrap-select-master/dist/css/bootstrap-select.min.css");?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo base_url("vendors/jquery/dist/jquery.min.js");?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url("vendors/bootstrap/dist/js/bootstrap.min.js");?>"></script>
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url("vendors/jquery.tagsinput/src/jquery.tagsinput.js");?>"></script>
	<!-- Select2 -->
	  <script src="<?php echo base_url("vendors/select2/dist/js/select2.min.js"); ?>"></script>

    <script src="<?php echo base_url("vendors/jquery/src/jquery-ui.js");?>"></script>

    <!-- bootstrap select -->
    <script src="<?php echo base_url("vendors/bootstrap-select-master/dist/js/bootstrap-select.min.js");?>"></script>




  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- v_menubar  -->
          <?php echo $v_menubar;?>
        <!-- /v_menubar  -->

        <!-- top navigation -->
          <?php echo $v_header;?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?php echo $v_mainpage;?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <?php echo $v_footer;?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <!-- FastClick -->
    <script src="<?php echo base_url("vendors/fastclick/lib/fastclick.js");?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url("vendors/nprogress/nprogress.js");?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url("vendors/moment/min/moment.min.js");?>"></script>
    <script src="<?php echo base_url("vendors/bootstrap-daterangepicker/daterangepicker.js");?>"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url("vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js");?>"></script>
    <!-- Ion.RangeSlider -->
    <script src="<?php echo base_url("vendors/ion.rangeSlider/js/ion.rangeSlider.min.js");?>"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="<?php echo base_url("vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js");?>"></script>
    <!-- jquery.inputmask -->
    <script src="<?php echo base_url("vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js");?>"></script>
    <!-- jQuery Knob -->
    <script src="<?php echo base_url("vendors/jquery-knob/dist/jquery.knob.min.js");?>"></script>
    <!-- Cropper -->
    <script src="<?php echo base_url("vendors/cropper/dist/cropper.min.js");?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url("vendors/datatables.net/js/jquery.dataTables.min.js");?>"></script>
    <!-- <script src="<?php echo base_url("vendors/datatables.net-bs/js/dataTables.bootstrap.min.js");?>"></script> -->


    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url("vendors/bootstrap-progressbar/bootstrap-progressbar.min.js");?>"></script>

	<script src="<?php echo base_url("build/js/custom_edit.js");?>"></script>



  </body>
</html>
