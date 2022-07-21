<!DOCTYPE html>
<html>
    <head> 
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Interview Assignment</title>
		<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css')?>" rel="stylesheet">
    </head> 
	<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">Assignment</a>
		</div>
		<ul class="nav navbar-nav">
		  <li class="active"><a href="<?php echo site_url('customers/index')?>">Daily Report</a></li>
		  <li><a href="<?php echo site_url('customers/monthly')?>">Monthly Report</a></li>
		</ul>
	  </div>
	</nav>
	  
	<div class="container">
	<div class="details top-block">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group1">
					<input type="text" class="form-control" name="from" id="from" placeholder="from" required>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group1">
					<input type="text" class="form-control" name="to" id="to" placeholder="to" required>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group1">
					<select name="company" id="company" class="form-control" required>
						<option value="">Select</option>
						<?php foreach($companies as $company) { ?>
						<option value="<?php echo  $company->id; ?>"><?php echo  $company->name; ?></option>

						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group1">
					<select name="country" id="country" class="form-control" required>
						<option value="">Select</option>
						<?php foreach($countries as $country) { ?>
						<option value="<?php echo  $country->id; ?>"><?php echo  $country->country_name; ?></option>

					<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group1">
					<input class="btn btn-primary "  value="Search" onclick="searchTest()" >
				</div>
			</div>
		</div>

	</div>
	</div>
	
	<div class="container">
	<br>
	<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>Company</th>
				<th>Month</th>
				<th>Country</th>
				<th>Number of tests</th>
				<th>Number of fails</th>
				<th>Connection Score</th>
				<th>PDD Score</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	</div>

	<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js')?>"></script>


	<script type="text/javascript">
		$(function () {
		  $('#from').datetimepicker({
			 format:'YYYY-MM-DD HH:mm:ss'
		  });
		});
		$(function () {
		  $('#to').datetimepicker({
			 format:'YYYY-MM-DD HH:mm:ss'
		  });
		});

	var table;



	function searchTest() {
		 var from = $("#from").val();
		 var to = $("#to").val();
		 var country = $("#country").val();
		 var company = $("#company").val();
	   
		 table = $('#table').DataTable({
			"destroy": true, 
			"lengthChange": false,
			"searching": false,
			"pageLength": 20,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo site_url('customers/get_mothlyReport')?>",
				"type": "POST",
				"data": {from: from,to: to,country: country,company: company}
			},

			//Set column definition initialisation properties.
			"columnDefs": [
			{ 
				"targets": [ 0 ], //first column / numbering column
				"orderable": false, //set not orderable
			},
			],

		});
	  
	  

	}
	</script>
	</body>
</html>