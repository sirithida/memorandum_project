
<!DOCTYPE html>
<html>
  <head>
    <style>
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;

      }
      th, td {
          padding: 8px;
      }
      div.container{
        width: 100%;
      }
      div.test{
        float : right;
      }
      div.footer{
        float : left;
      }

    </style>
  </head>
<body>
  <div class="container">
    <table id="memorandum_preview" align="center" width="100%">
      <tr>
        <th colspan="2">
          <img src="<?php echo base_url("hr_images/nitto.jpg");?>" width="150" height="50" align="left">
          <p ><h3>MEMORANDUM PREVIEW</h3></p>
          <tr>
              <td width="50%"><b> TO : </b> Mr.Sontaya P.</td>
              <td><b> DIVISION FOR HR :</b> <?php echo $hrsection_report->row()->div_name ?> </td>
          </tr>
          <tr>
              <td><b> FROM : </b><?php echo $report_preview->row()->create_by ?></td>
              <td><b> REQUEST OF DIVISION : </b> <?php echo $report_preview->row()->form_section ?> </td>
          </tr>
          <tr>
              <td width="50%"><b> MEMO NO : </b><?php echo $report_preview->row()->hr_memo_no ?></td>
              <td><b> REQUEST DATE : </b><?php echo $report_preview->row()->form_date ?></td>
          </tr>
          <tr>
            <td><b> SUBJECT : </b> <?php echo $report_preview->row()->form_subject ?></td>
          </tr>

          <tr>
            <div class="container">
              <td colspan="2">
                <p align="center"> LIST NAME REQUEST
                <table align="center" width="80%">
                  <tr align="center">
                    <th width="5%"> No. </th>
                    <th width="10%"> ID No.</th>
                    <th width="20%"> Name </th>
                    <th width="10%"> Description </th>
                    <th width="15%"> Date </th>
                    <th width="15%"> Time</th>
                    <th width="5%"> Transport </th>
                  </tr>
              <?php $i = 0;
                foreach ($bus->result() as $key => $value){
                  if ($value->pic_trans == 0) {
                    $pic_trans = "/";
                  }else {
                    $pic_trans = "X";
                  } ?>
                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $value->personal_id ?></td>
                    <td><?php echo $value->personal_name.' '.$value->personal_lastname ?></td>
                    <td></td>
                    <td><?php echo $value->emp_start_date.' - '.$value->emp_end_date ?></td>
                    <td><?php echo $value->start_time.' - '.$value->end_time ?></td>
                    <td><?php echo $pic_trans ?></td>
                  </tr>
                <?php } ?>
                </table>
                <br />
                <br />
              </br>

                <div class="container">
                  <table align="right" width="50%">
                    <tr align="center">
                      <?php foreach ($pdf_approve->result() as $key => $value): ?>
                        <td width="20%" text-align="center"><?php echo $value->position_name ?></td>
                      <?php endforeach ?>
                    </tr>
                    <tr align="center">
                      <?php foreach ($pdf_approve->result() as $key => $value): ?>
                        <td width="20%"><?php echo $value->personal_name ?></td>
                      <?php endforeach; ?>
                    </tr>
                    <tr align="center">
                      <?php foreach ($pdf_approve->result() as $key => $value): ?>
                        <?php if ($value->app_form_status == 2){
                          $status = "PASS";
                        }else {
                          $status = "NOPASS";
                        } ?>
                        <td width="10%"><?php echo $status ?></td>
                      <?php endforeach; ?>
                    </tr>
                    <tr align="center">
                      <?php foreach ($pdf_approve->result() as $key => $value): ?>
                        <td width="20%"><?php echo $value->approve_time ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </table>
                </div>
              </p>
              </td>
            </div>
          </tr>
        </th>
      </tr>
    </table>
    <br />
    <div>
      <!-- <span class="footer" width="50%">EFFECTIVE DATE : 1/10/03 </span> -->
      <span class="test" >เลขที่เอกสาร : FM-GA/MR-001 REVO4</span>
    </div>
    <br />
          <!--  <form class="container" align="center" method="post" >
                <a href="<?php echo site_url('memo_controller/pdf_controller/load_pdf?subject='.$preview_pdf->row()->form_id);?>">Link Button</a>
            </form> -->
          </div>
        </body>
        </html>
