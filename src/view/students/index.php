
<!-- Datatable !-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  

 
<!-- End datatable !-->

<div id="body_general">
<div id="accounttile">
  <div class="col-sm-12 col-sm-6">
    <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
  </div>
</div>

  <div class="container">
    <div class="jumbotron jumbotron-fluid pt-3 bg-white">
      <div id="accounttile" class="container">
        <h3>Students</h3>
        <div class="row">
          <div class="container">
			<div class="table-responsive" style="font-size:0.81rem">
							
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="8%">Photo</th>
							<th width="20%">Matric no.</th>
							<th width="17%">Full name</th>
							<th width="10%">School</th>
							<th width="22%">Location</th>
							<th width="15%">Created</th>
							<th width="8%">Action</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
</div>


<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<label>Enter First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control" />
					<br />
					<label>Enter Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control" />
					<br />
					<label>Select User Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(event){
		
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"view/students/fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
		

	});

	
			
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"view/students/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#firstname').val(data.firstname);
				$('#lastname').val(data.lastname);
				$('.modal-title').text("Edit Student");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(event){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"view/students/delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					console.log(data);
					dataTable.ajax.reload();
				}
			});
			
		event.preventDefault();
		}
		else
		{
			return false;	
		}
	});
	
	event.preventDefault();
});
</script>