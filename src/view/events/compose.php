<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>
  
  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/decoupled-document/ckeditor.js"></script>

  <div class="container">
    <div class="jumbotron jumbotron-fluid pt-3 bg-white">
      <div id="accounttile" class="container">
        <h3><span class="fa fa-envelope"></span> Compose</h3>
        <div class="row">
          <div class="container">

            <?php


            $locating = escape($user->data()->location);
            $userSyscategory = escape($user->data()->syscategory);
            $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

            if ($userSyscategory == 2 || $userSyscategory == 3 || $userSyscategory == 4) {

            ?>
              <form autocomplete="off">
                <div class="form-group">
                  <label for="name" class="sr-only">Subject</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="Subject" />

                </div>
                <div class="form-group">
                  <!-- The toolbar will be rendered in this container. -->
                  <div id="toolbar-container"></div>

                  <!-- This container will become the editable. -->
                  <div id="editor">
                    <p>--Type your message here--</p>
                  </div>
                </div>
                <script>
                  DecoupledEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                      const toolbarContainer = document.querySelector('#toolbar-container');

                      toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                    })
                    .catch(error => {
                      console.error(error);
                    });
                </script>


                <div id="submitButton">
                  <button type="button" id="save" class="btn btn-light">
                    <span class="fa fa-send-o"> Send</span>
                  </button>
                </div>
              </form>
            <?php
            }

            ?>
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
        let added_by = $('#added_by').val();


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
            token: token,
            added_by: added_by

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