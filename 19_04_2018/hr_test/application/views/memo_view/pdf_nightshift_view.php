
<html>
<head>
  <style>
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          align: center;
      }

      th, td {
          padding: 5px;
          text-align: left;
      }

      @page {
        size: A4;
        margin: 0;
      }
      @media print {
        html, body {
          width: 210mm;
          height: 297mm;
        }
        /* ... the rest of the rules ... */
      }

      @media print {
      #printPageButton {
        display: none;
      }
      }
  </style>

  <link href="<?php echo base_url("vendors/bootstrap/dist/css/bootstrap.min.css");?>" rel="stylesheet">
</head>
<body>
    <div class="container" style="width:50%">
      <center><h2>NIGHTSHIFT REPORT </h2></center>
        <center><p>Preview nightshit</p></center>
          <div class="x_content">
            <form id="form_input" <?php echo form_open_multipart("memo_controller/report_email_controller/update_status", array("id"=>"submit" ,"class"=>"form-horizontal form-label-left"))?>
              <table class="table table-bordered" style="Width:90%" align="center">
                <tr>
                <td>MEMO NO : <?php echo $nightshift_report->row()->night_no  ?></td>
                  <td></td>
                </tr>

                <tr>
                  <td>START OF DAY :  <?php echo  $nightshift_report->row()->night_start ?>  </td>
                  <td>END OF DAY : <?php echo  $nightshift_report->row()->night_end ?></td>
                </tr>

                <tr>
                  <td>SECTION :  <?php echo  $nightshift_report->row()->sec_name ?>  </td>
                  <td>DESCRIPTION : <?php echo  $nightshift_report->row()->night_operate ?></td>
                </tr>

              </table>
              <?php foreach ($nightshift_report->result() as $key => $value): ?>
                <table class="table table-bordered" style="width:90%" align="center">
                  <thead>
                    <tbody>
                      <h>พนักงานคนที่ <?php echo ++$key; ?></h>
                    <tr>
                      <td>EMPLOYEE ID : <?php echo $value->night_personal ?></td>
                      <td></td>
                    </tr>

                    <tr>
                      <td>NAME : <?php echo $value->night_user ?></td>
                      <td>SURNAME : <?php echo $value->night_lastname ?></td>
                    </tr>

                    </tbody>
                  </thead>

                </table>
              <?php endforeach; ?>
          </div>
      <div>
        <center><a class="btn btn-default" href="<?php echo site_url('memo_controller/pdf_nightshift_controller/load_pdf?subject='.$value->night_no)?>">PRINT</a></center>
    </div>
</body>
</html>
