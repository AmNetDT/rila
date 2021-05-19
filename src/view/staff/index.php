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
          <h3>Staff</h3>
          <div class="row">
            <div class="container">

              <div class="table-responsive data-font">
                <?php

                $staff = Db::getInstance()->query("SELECT * FROM staff_record");

                if (!$staff->count()) {
                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                } else {

                ?>
                  <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th width="20">SN</th>
                        <th width="150">Employee ID</th>
                        <th width="180">Full name</th>
                        <th width="180">Category</th>
                        <th width="100">Location</th>
                        <th width="160">School</th>
                        <th width="140">Created</th>
                        <th width="30">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach ($staff->results() as $staff) {

                      ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $staff->employee_id ?></td>
                          <td><?php echo $staff->firstname . " " . $staff->lastname ?></td>
                          <td><?php echo $staff->category ?></td>
                          <td><?php echo $staff->location ?></td>
                          <td><?php echo $staff->schools ?></td>
                          <td><?php echo $staff->created ?></td>
                          <td>
                            <div class="_view">
                              <form method="post">
                                <input type="hidden" value="<?php echo $staff->id ?>" id="stay_" />
                                <button tyle="submit" id="<?php echo $staff->id ?>" class="fa fa-search btn btn-default border rst<?php echo $staff->id; ?>"></button>
                              </form>
                            </div>
                          </td>
                        </tr>

                    </tbody>
                  </table>
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
<?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}


?>

<!-- page loader !-->
<script>
  $("#loader_httpFeed").hide();
  $(document).on('click', '._view', function(e) {

    //Passing values to nextPage 
    //let id = $(this).attr("id");
    let id = $('#stay_').val();

    $("#loader_httpFeed").show();
    $.ajax({
      type: "POST",
      url: "view/staff/view.php",
      data: {
        id: id
      },
      cache: false,
      success: function(msg) {
        $("#contentbar_inner").html(msg);
        $("#loader_httpFeed").hide();
      },
      error: function(xhr) {
        if (xhr.status == 404) {
          $("#loader_httpFeed").hide();
          dalert.alert("internet connection working");
        } else {
          $("#loader_httpFeed").hide();
          dalert.alert("internet is down");
        }
      }
    });
    return false;
    e.preventDefault();
  });
</script>