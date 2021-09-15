 <?php

    require_once '../../core/init.php';
    $user_id = $_POST['user_id'];
    $user = new User();
    if ($user->isLoggedIn()) {

    ?>

     <div class="container">

         <div class="px-3 text-center">

             <?php

                $username_id = escape($user->data()->id);
                $locating = escape($user->data()->location);
                $userSyscategory = escape($user->data()->syscategory);


                if ($userSyscategory == 1) {

                    $users = Db::getInstance()->query("SELECT * FROM users WHERE id=$user_id");
                    foreach ($users->results() as $use) {

                ?>
                     <form method="POST" autocomplete="off">
                         <div class="form-group">
                             <label for="username" class="sr-only">User_id</label>
                             <input type="text" name="username" value="<?php echo $use->username; ?>" id="username" class="form-control" disabled />
                         </div>
                         <div class="form-group">
                             <label for="syscategory" class="sr-only">Privilege</label>
                             <select class="form-control" name="syscategory" id="syscategory">

                                 <?php
                                    $syscat_id = $use->syscategory;
                                    $Syscate = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id`=$syscat_id");
                                    foreach ($Syscate->results() as $Sysca) {
                                    ?>
                                     <option value="<?php echo $Sysca->id; ?>"><?php echo $Sysca->name; ?></option>
                                 <?php
                                    }
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
                             <label for="school" class="sr-only">Programme</label>
                             <select class="form-control" name="school" id="school" disabled>
                                 <option value="14">Admin Staff</option>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="location" class="sr-only">Location</label>
                             <select class="form-control" name="location" id="location">

                                 <?php
                                    $location_id = $use->location;
                                    $location = Db::getInstance()->query("SELECT * FROM `locations` WHERE `id`=$location_id");
                                    foreach ($location->results() as $locat) {
                                    ?>
                                     <option value="<?php echo $locat->id; ?>"><?php echo $locat->name; ?></option>
                                 <?php
                                    }
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
                             <label for="password" class="sr-only">Password</label>
                             <input type="password" name="password" id="password" class="form-control" />
                         </div>
                         <div class="form-group">
                             <label for="confirm_password" class="sr-only">Confirm Password</label>
                             <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                         </div>
                         <input type="hidden" name="user_id" id="user_id" value="<?php echo $username_id; ?>" />
                         <div id="submitButton">
                             <button type="button" id="save" class="btn btn-light mb-3">
                                 <span class="fa fa-edit"> Update</span>
                             </button>
                             <input type="hidden" name="token" id="token" value="<?php echo Token::generate() ?>" />
                         </div>

                     </form>
                 <?php }
                } else if ($userSyscategory == 2) {

                    $users = Db::getInstance()->query("SELECT * FROM users WHERE id=$user_id");
                    foreach ($users->results() as $use) {

                    ?>
                     <form method="POST" autocomplete="off">
                         <div class="form-group">
                             <label for="username" class="sr-only">Username</label>
                             <input type="text" name="username" value="<?php echo $use->username; ?>" id="username" class="form-control" disabled />
                         </div>
                         <input type="hidden" value="5" name="syscategory" id="syscategory" />
                         <input type="hidden" value="<?php echo $use->location; ?>" name="location" id="location" />
                         <div class="form-group">
                             <label for="school" class="sr-only">Certificate</label>
                             <select class="form-control" name="school" id="school">
                                 <?php
                                    $certificate = $use->certificate;
                                    $schools = Db::getInstance()->query("SELECT * FROM `certificates` WHERE id=$certificate");
                                    foreach ($schools->results() as $schools) {
                                    ?>
                                     <option value="<?php echo $schools->id; ?>"><?php echo $schools->title; ?></option>
                                 <?php
                                    }

                                    $certifi = Db::getInstance()->query("SELECT * FROM `certificates` WHERE ID !=14 ORDER BY `id` DESC");
                                    foreach ($certifi->results() as $certi) {

                                    ?>
                                     <option value="<?php echo $certi->id; ?>"><?php echo $certi->title; ?></option>
                                 <?php
                                    }

                                    ?>
                             </select>
                         </div>

                         <div class="form-group">
                             <label for="password" class="sr-only">Password</label>
                             <input type="password" name="password" id="password" placeholder="Password" class="form-control" />
                         </div>
                         <div class="form-group">
                             <label for="confirm_password" class="sr-only">Confirm Password</label>
                             <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control" />
                         </div>
                         <input type="hidden" name="user_id" id="user_id" value="<?php echo $username_id; ?>" />
                         <div id="submitButton">
                             <button type="button" id="save" class="btn btn-light mb-3">
                                 <span class="fa fa-edit"> Update</span>
                             </button>
                             <input type="hidden" name="token" id="token" value="<?php echo Token::generate() ?>" />
                         </div>

                     </form>
             <?php
                    }
                }

                ?>
             <span style="font-size:small">Note: New password is mandatory.</span>
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

             let id = $('#user_id').val();
             let username = $('#username').val();
             let syscategory = $('#syscategory').val();
             let school = $('#school').val();
             let location = $('#location').val();
             let password = $('#password').val();
             let confirm_password = $('#confirm_password').val();
             let token = $('#token').val();


             $.ajax({
                 url: "view/users/update_user_server",
                 method: 'POST',
                 data: {
                     user_id: id,
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
                     //dataTable.ajax.reload();

                 }
             });

         });
         event.preventDefault();
     });
 </script>