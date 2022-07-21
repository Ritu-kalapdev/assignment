<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interview Assignment</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    
    </head> 
<body>
    <div class="container">
        <!--h1 style="font-size:20pt">Interview Assignment</h1>

        <h3>Report Page</h3-->
		
        <br> 
<div class="details-block-dealer top-block">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group1">
                                        <input type="text" class="form-control" name="to" id="to" placeholder="to">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group1">
                                            <input type="text" class="form-control" name="from" id="from" placeholder="from">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group1">
                                            <input type="text" class="form-control" name="Company" id="Company" placeholder="Company">
                                    </div>
                                </div>
								 <div class="col-md-3">
                                    <div class="form-group1">
                                            <input type="text" class="form-control" name="Country" id="Country" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group1">
                                        <input  class="btn btn-primary " name="dealerNumber" value="Search" onclick="search()" readonly="">
                                       
                                    </div>
                                </div>
                            </div>
						
                          </div>
		<br>
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Company</th>
                    <th>Day</th>
                    <th>Country</th>
                    <th>Number of tests</th>
                    <th>Number of fails</th>
                    <th>Connection Score</th>
                    <th>PDD Score</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Company</th>
                    <th>Day</th>
                    <th>Country</th>
                    <th>Number of tests</th>
                    <th>Number of fails</th>
                    <th>Connection Score</th>
                    <th>PDD Score</th>
                </tr>
            </tfoot>
        </table>
    </div>

<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>


<script type="text/javascript">

var table;

//$(document).ready(function() {
function search(){
    //datatables
    table = $('#table').DataTable({ 
		"lengthChange": false,
		"searching": false,
        "pageLength": 20,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('customers/ajax_list')?>",
            "type": "POST"
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
//});

</script>

</body>
</html>