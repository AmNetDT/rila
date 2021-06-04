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
      $('#abdusalaam').DataTable();
      $('#abd').DataTable();
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
          <h3>Programmes</h3>
          <div id="btn_c" style="text-align: right;">
            <?php

            $username = escape($user->data()->username);
            $userSyscategory = escape($user->data()->syscategory);


            ?>

            <button class="view_programme_type border">
              <span class="fa fa-search"> Titles</span>
            </button>

          </div>
          <div class="row">
            <div class="col-sm-12 px-0">
              <div class="card">
                <div class="card-body">
                  <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <h6 class="card-title p-2">All Programmes</h6>
                  </div>


                  <?php
                  if ($userSyscategory == 2) {

                    $programmea = Db::getInstance()->query("SELECT * FROM `programmes` WHERE added_by = '$username' AND programme_type !=1 ORDER BY id DESC");
                    if (!$programmea->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                  ?>

                      <div class="table-responsive data-font">
                        <table id="abdusalaam" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">SN</th>
                              <th scope="col">Created</th>
                              <th scope="col">Modified</th>
                              <th scope="col">Title</th>
                              <th scope="col">Session</th>
                              <th scope="col">Course Duration</th>
                              <th scope="col">Created BY</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $i = 1;
                            foreach ($programmea->results() as $programme) {

                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $programme->created; ?></td>
                                <td><?php echo $programme->modified; ?></td>
                                <td><?php echo $programme->name; ?></td>
                                <td><?php echo $programme->session; ?></td>
                                <td><?php echo $programme->duration; ?></td>
                                <td><?php echo $programme->added_by; ?></td>
                                <td>
                                  <div id="<?php echo $programme->id ?>" land="<?php echo $programme->added_by ?>" class="edit_programme" style="float:left;">
                                    <button class="btn btn-default border">
                                      <span class="fa fa-edit"></span>
                                    </button>
                                  </div>
                                </td>
                              </tr>
                            <?php
                            }
                            ?>

                          </tbody>
                        </table>

                      </div>

                    <?php
                    }
                  } else {

                    $programmea = Db::getInstance()->query("SELECT * FROM `programme` WHERE programme_type !=1 ORDER BY id DESC");
                    if (!$programmea->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                    ?>
                      <div class="table-responsive data-font">
                        <table id="abd" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">SN</th>
                              <th scope="col">Created</th>
                              <th scope="col">Modified</th>
                              <th scope="col">Matric No.</th>
                              <th scope="col">Campus</th>
                              <th scope="col">Title</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Paid</th>
                              <th scope="col">Balance</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $i = 1;
                            foreach ($programmea->results() as $programme) {

                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $programme->created; ?></td>
                                <td><?php echo $programme->modified; ?></td>
                                <td><?php echo $programme->matric_no; ?></td>
                                <td>
                                  <?php
                                  //echo $programme->added_by;
                                  $campu = $programme->added_by;
                                  $cmpuspay = Db::getInstance()->query("SELECT l.name AS campusname FROM `users` AS u, `locations` AS l WHERE u.username = '$campu' AND l.id=u.location");
                                  foreach ($cmpuspay->results() as $campuspa) {

                                    echo $campuspa->campusname;
                                  }

                                  ?>
                                </td>
                                <td><?php
                                    $programme_type = $programme->programme_type;

                                    ?>

                                  <?php

                                  $programmesty = Db::getInstance()->query("SELECT * FROM `programme_type` WHERE id = $programme_type");
                                  if (!$programmesty->count()) {
                                    echo "<h4 class='my-5 text-center'>Not available</h4>";
                                  } else {
                                    foreach ($programmesty->results() as $programmest) {
                                      echo $programmest->name;
                                    }
                                  }
                                  ?>

                                </td>
                                <td><?php echo $programme->amount; ?></td>
                                <td><?php echo $programme->paid; ?></td>
                                <td><?php echo $programme->balance; ?></td>
                              </tr>

                            <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>

                  <?php
                    }
                  }
                  ?>
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