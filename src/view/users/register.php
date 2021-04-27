<?php
require_once '../../core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('../../login/index');
}

        $smsg;
        $fmsg;

        if(Input::exists()){
          if(Token::check(Input::get('token'))){
              $validate = new Validate();
              $validation = $validate->check($_POST, array(
                
                    'username'        => array(
                    'required'        => true,
                    'min'             =>  7
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
                    'status'          => array(
                    'require'         => true
                ),
                    'password'        => array(
                    'require'         => true,
                    'min'             => 6
                ),
                    'password_again'  =>  array(
                    'required'        =>  true,
                    'matches'         => 'password'
                )
              ));

              if($validation->passed()){
                  $user = new User();
                  $salt = Hash::salt(32);
                  //echo $salt;
                  //die();
                    try{
                        $user->create(array(
                            'username'     => Input::get('username'),
                            'syscategory' => Input::get('syscategory'),
                            'school'     => Input::get('school'),
                            'location'     => Input::get('location'),
                            'status'     => Input::get('status'),
                            'password' => Hash::make(Input::get('password'), $salt),
                            'salt'     => $salt,
                            'joined'   => date('Y-m-d H:i:s')
                        ));
                        Session::flash('console', 'You have successfully registered');
                        Redirect::to('console');

                    }catch(Exception $e){
                        die($e->getMessage());
                    }

             }else{

                  foreach($validation->errors() as $error){
                      $fmsg = $error .'<br/>';
                  }

             }
              
          }
        }
?>


  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png" />
  <title>RILA</title>
  <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
         
         
            
            <div class="card-body px-3 text-center">
             <h3>New User</h3>
              <form method="POST" class="row" autocomplete="off">
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="sr-only">Username</label>
                    <input type="text" name="username" value="<?php echo escape(Input::get('username')); ?>" 
                    id="UserId" class="form-control" placeholder="Username" />
                  </div>
                  <div class="form-group">
                    <label for="username" class="sr-only">Syscategory</label>
                     <select class="form-control">
                      <option selected>Privilege</option>
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
                    <label for="password_again" class="sr-only"> Password</label>
                    <input type="password" name="password" class="form-control" 
                    placeholder="Password" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="school" class="sr-only">School</label>
                      <select class="form-control">
                      <option selected>Type of School</option>
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
                     <select class="form-control">
                      <option selected>Campus</option>
                    <?php
                       
                       $location = Db::getInstance()->query("SELECT * FROM `location` ORDER BY `id` DESC");
                       foreach($location->results() as $location){
                      
                      ?>
                      <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                    <?php
                       }
                    ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="password_again" class="sr-only">Confirm Password</label>
                    <input type="password" name="password_again" class="form-control" 
                    placeholder="Confirm Password" />
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                  </div>
                </div>
                  
      <div id="btn_c" class="form-group" style="float:left">
        <button class="border my-3" type="submit">
          <span class="icon-save"> Save</span>
        </button>
      </div>
                 <p><?php if(isset($fmsg)){ echo '<div class="alert alert-danger">' . $fmsg .'<div>'; }else if(isset($smsg)){echo $smsg;}; ?></p>
                 
                </form>
                
            </div>
          </div>
        
      </div>
    </div>
   
    </div>
</body>
</html>
