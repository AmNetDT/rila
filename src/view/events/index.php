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

    <?php

    $username = escape($user->data()->id);
    $userSyscategory = escape($user->data()->syscategory);
    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

   

    ?>
      <div class="container">
        <div class="jumbotron jumbotron-fluid pt-3 bg-white">
          <div id="accounttile" class="container">
            <h3><span class="fa fa-envelope"></span> Inbox</h3>
            <div class="row">
              <div class="container">
                


                <div class="table-responsive data-font">
                  <?php

                  $location = escape($user->data()->location);

                  $inbox = Db::getInstance()->query("SELECT * FROM inbox WHERE location = $location");

                  if (!$inbox->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                  ?>
                    <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Title</th>
                          <th>Message</th>
                          <th>Composed By</th>
                          <th>Date & Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($inbox->results() as $inbo) {

                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $inbo->title; ?></td>
                            <td><?php echo $inbo->message; ?></td>
                            <td><?php
                                $added_id = $inbo->added_by;
                                $addedby = Db::getInstance()->query("SELECT * FROM `users` WHERE `id`=$added_id");
                                foreach ($addedby->results() as $added) {
                                  echo $added->username;
                                }
                                ?></td>
                            <td><?php echo $inbo->joined; ?></td>
                            <td>
                              <div id="btn_c" style="float:left;">
                                <button id="<?php echo $inbo->id; ?>" class="edit_user btn btn-default border rst<?php echo $inbo->id; ?>" lang="<?php echo $inbo->title; ?>"><span class="fa fa-edit"></span></button>
                              </div>
                              <div id="btn_c" style="float:left">
                                <button class="delete_row btn btn-default border" title="<?php echo $inbo->id; ?>" lang="inbox"><span class="fa fa-trash"></span></button>
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

  <?php
    
  } else {
    $user->logout();
    Redirect::to('../../login/');
  }


  ?>