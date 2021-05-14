<?php
require_once '../../core/init.php';

        $fmsg;
        $smsg;

        if(Input::exists()){
          if(Token::check(Input::get('token'))){
              $validate = new Validate();
              $validation = $validate->check($_POST, array(
                    'username'        => array(
                    'required'        => true,
                    'min'             =>  6,
                    'max'             =>  11
                ),
                    'syscategory'     => array(
                    'require'         => true
                ),
                    'school'          => array(
                    'require'         => true
                ),
                    'location'        => array(
                    'require'         => true
                ),
                    'password'        => array(
                    'require'         => true,
                    'min'             => 6
                ),
                    'confirm_password'  =>  array(
                    'required'          =>  true,
                    'matches'           => 'password'
                )
              ));

              if($validation->passed()){
                  $user = new User();
                  $salt = Hash::salt(32);
                  //echo $salt;
                  //die();
                    try{
                        $user->create(array(
                            'username'      => Input::get('username'),
                            'syscategory'   => Input::get('syscategory'),
                            'school'        => Input::get('school'),
                            'location'      => Input::get('location'),
                            'password'      => Hash::make(Input::get('password'), $salt),
                            'salt'          => $salt,
                            'joined'        => date('Y-m-d H:i:s')
                        ));
                        $smsg = 'You have successfully registered';

                    }catch(Exception $e){
                        die($e->getMessage());
                    }

             }else{

                  foreach($validation->errors() as $error){
                      $fmsg = $error . '<br />';
                      
                  }

             }
              
          }
        }

?>



  <div class="container">
    <div class="row justify-content-center py-3">
         
          <div class="col-sm-10 pt-3 border radius">
            
            <div class="card-body px-3 text-center">
           <p class="login-card-description mt-2">
           Register a new user account</p>
              <form method="POST" class="row p-3" autocomplete="off">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" 
                    id="UserId" class="form-control" placeholder="Username" />
                  </div>
                  <div class="form-group">
                    <label for="syscategory" class="sr-only">Syscategory</label>
                     <select class="form-control" name="syscategory" id="syscategory">
                      <option selected>--Select Privilege--</option>
                    <?php
                       
                       $Syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` ORDER BY `id` ASC");
                       foreach($Syscategory->results() as $Syscategory){
                      
                      ?>
                      
                      <option value="<?php echo $Syscategory->id; ?>"><?php echo $Syscategory->name; ?></option>
                    <?php
                       }
                    ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="password" class="sr-only"> Password</label>
                    <input type="password" name="password" id="password" class="form-control" 
                    placeholder="Password" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="school" class="sr-only">School</label>
                      <select class="form-control" name="school" id="school">
                      <option selected>--Type of School--</option>
                    <?php
                       
                       $schools = Db::getInstance()->query("SELECT * FROM `schools` ORDER BY `id` DESC");
                       foreach($schools->results() as $schools){
                      
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
                       foreach($location->results() as $location){
                      
                      ?>
                      <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                    <?php
                       }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="confirm_password" class="sr-only">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" 
                    placeholder="Confirm Password" />
                    <input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>" />
                  </div>
                </div>
      <div class="form-group">
        <button class="btn btn-light border my-3" type="submit" id="save">
          <span class="fa fa-save"> Save</span>
        </button>
      </div>
                 <p><?php if(isset($fmsg)){ echo '<div class="alert alert-danger">' . $fmsg .'<div>'; }else if(isset($smsg)){echo $smsg;}; ?></p>
               
                </form>
                
            </div>
          </div>
        </div>
      </div>
    </div>
   
    </div>
   
