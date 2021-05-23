<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>


  <!-- Datatable !-->

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
  <script>
    $(document).ready(function() {
      $('#abdganiu').DataTable();
      $('#ganiu').DataTable();
    });
  </script>
  <!-- End datatable !-->

  <div id="body_general">
    <div id="accounttile" class="row">
      <div class="container">
        <span id="close"><span class="icon-times-rectangle text-danger text-lg"></span></span>
        <div>
        </div>

        <div class="container">
          <div class="jumbotron jumbotron-fluid pt-3 bg-white">
            <div id="accounttile" class="container">
              <h3>Payments</h3>
              <div id="btn_c" style="text-align: right;">
                <button class="reg_user border" type="submit">
                  <span class="fa fa-plus"> Add Payment</span>
                </button>
                <button class="reg_user border" type="submit">
                  <span class="fa fa-search"> Payment Types</span>
                </button>
              </div>
              <div class="row">
                <div class="container">
                  <div class="row">
                    <div class="container">
                      <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="col-md-6 my-3">
                          <!-- Still empty!-->
                        </div>
                        <div class="btn-toolbar col-md-6 my-3 p-0">

                          <!-- Still empty!-->

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 px-0">
                  <div class="card">
                    <div class="card-body">
                      <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                        <h6 class="card-title p-2">School Fee</h6>

                      </div>
                      <div class="table-responsive data-font">
                        <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Student</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Paid</th>
                              <th scope="col">Balance</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>ST001212</td>
                              <td>350,000</td>
                              <td>50,000</td>
                              <td>300,000</td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 px-0">
                  <div class="card m-0 p-0">
                    <div class="card-body">
                      <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                        <h6 class="card-title p-2">Other Payment</h6>
                      </div>
                      <div class="table-responsive data-font">
                        <table id="ganiu" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Student</th>
                              <th scope="col">Title</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Paid</th>
                              <th scope="col">Balance</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>ST001212</td>
                              <td>Matriculation</td>
                              <td>350,000</td>
                              <td>50,000</td>
                              <td>300,000</td>
                              <td></td>
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

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>