<?php 

require_once '../../core/init.php';

$user = new User();
if($user->isLoggedIn()){

?>


<div id="body_general">
<div id="accounttile">
  <div class="col-sm-12 col-sm-6">
    <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
  </div>
</div>

  <div class="container">
    <div class="jumbotron jumbotron-fluid pt-3">
      <div id="accounttile" class="container">
        <h3>Students</h3>
        <div class="row">
          <div class="container">
        <button class="sys_regts btn btn-light border mt-3" type="submit">+ Add Student</button>
        <button class="sys_regts btn btn-light border mt-3" type="submit">+ Add Scores</button>
<div class="table-responsive mt-2">
  <table class="table bg-white" id="genericTableFormtable" style="width:100%;">
    <tr>
      <th width="30" id="datatableColcontent">S/N</th>
      <th width="235" id="datatableColcontent">Student ID</th>
      <th width="696" id="datatableColcontent">Full name</th>
      <th width="336" id="datatableColcontent">School</th>
      <th width="336" id="datatableColcontent">Location</th>
      <th width="294" id="datatableColcontent">Status</th>
      <th width="294" id="datatableColcontent">&nbsp;</th>
    </tr>
    <tr class="rowOdd sys_edit_users rst">
      <td width="294">1</td>
      <td width="294">E003434</td>
      <td width="294">AbdGaniu Dosunmu</td>
      <td width="294">RCCG Camp</td>
      <td width="294">Admin</td>
      <td width="294">Active</td>
      <td width="20"><span class="icon-search"></span></td>
    </tr>
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
