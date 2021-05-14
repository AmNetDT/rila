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
        <h3>Manage User</h3>
        <div class="row">
          <div class="container">
            
                <a href="http://localhost/rila/rila/login/register">Click here to register!</a>
            
<div class="table-responsive">
<?php

              $user = Db::getInstance()->query("SELECT * FROM users");

                if(!$user->count()){
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                }else{

              ?>
  <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
   <thead>
            <tr>
                <th>SN</th>
                <th>Username</th>
                <th>Privilege</th>
                <th>School</th>
                <th>Location</th>
                <th>Created</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                    foreach($user->results() as $user){

            ?>
             
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $user->username; ?></td>
                <td><?php

                       $sysId = $user->syscategory;
                       $syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id`=$sysId");
                       foreach($syscategory->results() as $sysName){
                       print $sysName->name;

                       }
                ?></td>
                <td><?php

                       $schoolId = $user->school;
                       $schools = Db::getInstance()->query("SELECT * FROM `schools` WHERE `id`=$schoolId");
                       foreach($schools->results() as $school){
                       print $school->type;

                       }
                ?></td>
                <td><?php

                       $locationId = $user->location;
                       $locations = Db::getInstance()->query("SELECT * FROM `locations` WHERE `id`=$locationId");
                       foreach($locations->results() as $location){
                       print $location->name;

                       }
                ?></td>
                <td><?php echo $user->joined; ?></td>
                <td>
                        <div id="btn_c" style="float:left;">
                                <button class="btn sys_edit_users border"><span class="fa fa-edit"></span></button> 
                        </div>
                        <div id="btn_c" style="float:left">
                                <button class="btn btn_regis_01 border"><span class="fa fa-trash"></span></button> 
                        </div>
                </td>
            </tr>  
                      <?php
                    }
                      ?>

        </tbody>
  </table>
  <?php
        }
  ?>
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
 
