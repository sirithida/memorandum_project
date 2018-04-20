<script>
	$(document).ready(function(){
		$('#approve').DataTable( {
			columnDefs:[
				{targets:[0], orderData:[0,1]},
				{targets: [1], orderData: [1, 0]},
				{targets: [4], orderData: [4, 0]}
			]
		});
/*
		$('#myModal').on('.modal-dialog', function () {
			$('#myInput').focus()
		});
*/
		$("#myModalM").modal();
	});
</script>

<!-- Css datatable -->
<link href="<?php echo base_url("vendors/jquery.dataTables.min/jquery.dataTables.min.css");?>" rel="stylesheet">

<html>
  <head>
    <style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}

  </style>
</head>
<body>
	<!-- Button to Open the Modal -->
	<div class="container">
	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	</div>
  <table id="approve" class="display" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th> Action</th>
                  <th> Subject</th>
                  <th> Section</th>
                  <th> Requested By</th>
                  <th> Status</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($approve_hos->result() as $key => $value): ?>
             <tr>
                <td>
					<?php /*
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                      Open modal
                    </button>

					<!-- The Modal -->
					<div class="modal fade" id="myModal">
						<div class="modal-dialog/">
							<div class="modal-content">
								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Modal Heading</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									Modal body..
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					*/	?>
                </td>
              <!-- Approve Subject -->
                <td>
                <?php echo $value->form_subject ?>
                </td>
                <!-- Approve Super -->
                <td>
                <?php echo $value->sec_id ?>
                </td>
                <!-- Approve hos -->
                <td>
                  <?php echo $value->create_by ?>
                </td>
                <td>
                  Pass
                </td>
            </tr>
              <?php endforeach; ?>

         </tbody>
      </table>
    </body>
  </html>
