<?php 

require_once '../../core/init.php';

$user = new User();
if($user->isLoggedIn()){

?>

<!-- Datatable !-->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <script>
      $(document).ready(function () {
            $('#abdganiu').DataTable();
        });
</script>
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
        <h3>Staff</h3>
        <div class="row">
          <div class="container">
        
<div class="table-responsive">
  <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
   <thead>
            <tr>
                <th>SN</th>
                <th>Employee ID</th>
                <th>Full name</th>
                <th>Location</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>ED001234</td>
                <td>Ruqoyyah Salmon</td>
                <td>RCCG Camp</td>
                <td>Super Admin</td>
                <td>Active</td>
                <td>1982/01/14</td>
                <td>
                  <div id="btn_c" style="float:left">
                                <button class="btn view_staff_details border">
                                    <span class="fa fa-search"></span>
                                </button> 
                        </div>
                  </td>
            </tr> 
              
        </tbody>
  </table>
</div>   
</div>
      </div>
    </div>
  </div>
</div>
</div>
<?php

}else{
    $user->logout();
    Redirect::to('../../login/');
}


?>
 


