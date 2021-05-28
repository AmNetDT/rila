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
          <h3>Payments</h3>
          <div id="btn_c" style="text-align: right;">
            <?php
            $userSyscategory = escape($user->data()->syscategory);
            $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

            if ($userSyscategory != 2) {
            ?>

              <button class="view_payment_type border">
                <span class="fa fa-search"> Payment Titles</span>
              </button>

            <?php
            } else {
            ?>

              <button class="reg_user border">
                <span class="fa fa-plus"> Add Payment</span>
              </button>
              <button class="view_payment_type border">
                <span class="fa fa-search"> Payment Titles</span>
              </button>


            <?php
            }
            ?>
          </div>
          <div class="row">
            <div class="col-sm-12 px-0">
              <div class="card">
                <div class="card-body">
                  <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <h6 class="card-title p-2">All Payment Records</h6>

                  </div>
                  <div class="table-responsive data-font">
                    <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">Student</th>
                          <th scope="col">Matric No.</th>
                          <th scope="col">Payment Title</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Paid</th>
                          <th scope="col">Balance</th>
                          <?php
                          if ($userSyscategory == 2) {
                          ?>
                            <th scope="col">Action</th>
                          <?php
                          }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>ST001212</td>
                          <td>RILA/2021/PL/PGD/002345-OT</td>
                          <td>Matriculation</td>
                          <td>350,000</td>
                          <td>50,000</td>
                          <td>300,000</td>
                          <?php
                          if ($userSyscategory == 2) {
                          ?>
                            <td>
                              <div id="btn_c" style="float:left;">
                                <button id="<?php //echo $user->id; 
                                            ?>" class="edit_user btn btn-default border rst<?php //echo $user->id; 
                                                                                            ?>" lang="<?php //echo $user->username; 
                                                                                                      ?>"><span class="fa fa-edit"></span></button>
                              </div>
                              <div id="btn_c" style="float:left">
                                <button id="" class="delete_user_or_student btn btn-default border" title="<?php //echo $user->username; 
                                                                                                            ?>" lang="<?php //echo $user->syscategory; 
                                                                                                                      ?>"><span class="fa fa-trash"></span></button>
                              </div>
                            </td>
                          <?php
                          }
                          ?>

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