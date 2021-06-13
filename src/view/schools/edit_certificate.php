 <?php

    require_once '../../core/init.php';
    $id = $_POST['id'];
    $user = new User();
    if ($user->isLoggedIn()) {

    ?>
     <div class="row m-0 p-0">
         <div class="container">
             <div class="card" style="max-width: 100%;">
                 <div class="row no-gutters">
                     <h6>Certificate Titles</h6>

                     <div class="col-sm-12">

                         <?php

                            $ptype = Db::getInstance()->query("SELECT * FROM `certificates` WHERE id=$id");
                            foreach ($ptype->results() as $ptypes) {

                            ?>
                             <form autocomplete="off">

                            <div class="row">
                                <div class="form-group">
                                    <label for="programme" class="sr-only">Programme</label>
                                    <select class="form-control" name="programme" id="programme">
                                        <option selected>--Type of programme--</option>
                                        <?php

                                        $programmes = Db::getInstance()->query("SELECT * FROM `programmes` ORDER BY id DESC");
                                        foreach ($programmes->results() as $programmes) {

                                        ?>
                                            <option value="<?php echo $programmes->id; ?>"><?php echo $programmes->category; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="title" class="sr-only"> Certificate Title</label>
                                    <textarea name="title" id="title" class="form-control" cols="50" style="width: 100%" placeholder="Certificate Title">
                                    <?php
                                    echo $ptype->title;
                                    ?>
                                    </textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="duration" class="sr-only"> Duration</label>
                                    <input type="text" name="duration" id="duration" class="form-control" value="<?php echo $ptype->duration; ?>" />
                                </div>
                                
                                    <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                    <input type="hidden" name="id" id="id" value="<?php echo $ptype->id; ?>" />
                            </div>
                            <div class="row">

                                <div id="submitButton">
                                    <button type="button" id="save" class="btn btn-light">
                                        <span class="fa fa-save"> Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                            ?>
                     </div>
                 </div>
                 <div class="mt-3 mb-0 text-right">
                     <button class='myPop-close btn-danger'><span class='fa fa-times text-white'></span> Close</button>
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

             let id = $('#id').val();
             let member_id = $('#member_id').val();
             let matric_no = $('#matric_no').val();
             let added_by = $('#added_by').val();

             if (matric_no != '' && added_by != '') {
                 $.ajax({
                     url: "view/payments/edit_certificate_server",
                     method: 'POST',
                     data: {
                         'payment_id': payment_id,
                         'member_id': member_id,
                         'matric_no': matric_no,
                         'added_by': added_by
                     },
                     success: function(data) {

                         dalert.alert(data);
                         //dataTable.ajax.reload();

                     }
                 });
             } else {
                 dalert.alert("Payment Title is required");
             }
         });
         event.preventDefault();
     });
 </script>