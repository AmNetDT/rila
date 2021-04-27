<?php 

require_once '../../core/init.php';

$user = new User();
if($user->isLoggedIn()){

?>

<div id="body_general">
<div id="accounttile" class="row">
  <div class="container">
    <span id="close"><span class="icon-times-rectangle text-danger text-lg"></span></span>
    <div>
</div>

  <div class="container">
    <div class="jumbotron jumbotron-fluid pt-3">
      <div id="accounttile" class="container">
        <h3>Payments</h3>
        <div class="row">
          <div class="container">
          <div class="row">
          <div class="container">
          <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <div class="col-md-6 my-3">
                  <button class="btn btn-light sys_regts" type="submit">+ Add Payment</button>
                </div>
                <div class="btn-toolbar col-md-6 my-3 p-0">
                    
                      <form class="form-inline">
                      <select class="custom-select ml-3 mr-sm-3">
                        <option selected>--Academic Year--</option>
                        <option value="1">2018</option>
                        <option value="2">2019</option>
                        <option value="3">2020</option>
                      </select>
                      </form>
                      <span class="py-2">
                        Students > Master 232 | Degree 102
                      </span>
                
                </div>
          </div>
        </div>
        </div>
        </div>
        </div>
  <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <h5 class="card-title p-2">School Fee</h5>
        <a href="#" class="btn btn-default">Sort <span class="icon-sort-amount-desc"></span></a>
        </div>
        <div class="table-responsive">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student Id</th>
      <th scope="col">Amount</th>
      <th scope="col">Paid</th>
      <th scope="col">Balance</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>ST001212</td>
      <td>350,000</td>
      <td>50,000</td>
      <td>300,000</td>
    </tr>
  </tbody>
</table>
</div>
      </div>
    </div>
  </div>
    <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <h5 class="card-title p-2">Other Payment</h5>
        <a href="#" class="btn btn-default">Sort <span class="icon-sort-amount-desc"></span></a>
        </div>
        <div class="table-responsive">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student Id</th>
      <th scope="col">Amount</th>
      <th scope="col">Paid</th>
      <th scope="col">Balance</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>ST001212</td>
      <td>350,000</td>
      <td>50,000</td>
      <td>300,000</td>
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
 
