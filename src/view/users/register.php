<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>

  <div class="container">
    <div class="jumbotron jumbotron-fluid pt-1 bg-white">
      <div id="accounttile" class="container">

        <div class="card-body text-center">
          <p class="login-card-description">
            Register a new user account</p>
          <form class="row" autocomplete="off">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name" class="sr-only">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
              </div>
              <div class="form-group">
                <label for="syscategory" class="sr-only">Privilege</label>
                <select class="form-control" name="syscategory" id="syscategory">
                  <option selected>--Select Privilege--</option>
                  <?php

                  $Syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` ORDER BY `id` ASC");
                  foreach ($Syscategory->results() as $Syscategory) {

                  ?>

                    <option value="<?php echo $Syscategory->id; ?>"><?php echo $Syscategory->name; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="password" class="sr-only"> Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="school" class="sr-only">School</label>
                <select class="form-control" name="school" id="school">
                  <option selected>--Type of School--</option>
                  <?php

                  $schools = Db::getInstance()->query("SELECT * FROM `schools` ORDER BY `id` DESC");
                  foreach ($schools->results() as $schools) {

                  ?>
                    <option value="<?php echo $schools->id; ?>"><?php echo $schools->type; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="location" class="sr-only">Location</label>
                <select class="form-control" name="location" id="location">
                  <option selected>--Campus--</option>
                  <?php

                  $location = Db::getInstance()->query("SELECT * FROM `locations` ORDER BY `id` DESC");
                  foreach ($location->results() as $location) {

                  ?>
                    <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="confirm_password" class="sr-only">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" />
                <input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>" />
              </div>
            </div>
            <div id="submitButton">
              <button type="button" id="save" class="btn btn-light">
                <span class="fa fa-save"> Save</span>
              </button>
            </div>
          </form>

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

<script>
  $(document).ready(function(event) {
    $("#save").click(function() {


      let username = $('#username').val();
      let syscategory = $('#syscategory').val();
      let school = $('#school').val();
      let location = $('#location').val();
      let password = $('#password').val();
      let confirm_password = $('#confirm_password').val();
      let token = $('#token').val();


        $.ajax({
          url: "view/users/register_server",
          method: 'POST',
          data: {

            username: username,
            syscategory: syscategory,
            school: school,
            location: location,
            password: password,
            confirm_password: confirm_password,
            token: token

          },
          success: function(data) {

            dalert.alert(data);

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

    });
    event.preventDefault();
  });
</script>