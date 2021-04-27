<?php
        require_once 'core/init.php';
        $smsg;
        $fmsg;

        if(Input::exists()){
          if(Token::check(Input::get('token'))){
              $validate = new Validate();
              $validation = $validate->check($_POST, array(
                
                    'name'      => array(
                    'required'  => true,
                    'min'       =>  5 
                ),
                    'username'    => array(
                    'require'     => true,
                    'min'         => 5,
                    'unique'      => 'users' 
                ),
                    'password'   => array(
                    'require'    => true,
                    'min'        => 6
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
                            'name'     => Input::get('name'),
                            'username' => Input::get('username'),
                            'password' => Hash::make(Input::get('password'), $salt),
                            'salt'     => $salt,
                            'joined'   => date('Y-m-d H:i:s'),
                            'group'    => 1
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
    <div class="row justify-content-center py-3">
         
          <div class="col-sm-4 pt-3 border radius">
            
            <div class="card-body px-3 text-center">
              
              <img src="assets/images/logo.png" alt="logo" class="logo" />
              <p class="login-card-description mt-2">
              Login to your account</p>
              <form method="POST" action="" class="mb-5">
                  <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="UserId" 
                    class="form-control" placeholder="Full name" />
                  </div>
                  <div class="form-group">
                    <label for="username" class="sr-only">User</label>
                    <input type="text" name="username" value="<?php echo escape(Input::get('username')); ?>" 
                    class="form-control" placeholder="Username" />
                  </div>
                  <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" 
                    placeholder="Password" />
                  </div>
                  <div class="form-group">
                    <label for="password_again" class="sr-only">Confirm Password</label>
                    <input type="password" name="password_again" id="password" class="form-control" 
                    placeholder="Password" />
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                  </div>
                  
                  <div id="submitButton">
                  <button type="submit" id="" class="btn btn-primary px-5 mb-3">
  				         Register <img src="ext/loader.gif" style="width:17%; padding-left:10px;" id="loaders" />
                 </button>
                 <p><?php if(isset($fmsg)){ echo '<div class="alert alert-danger">' . $fmsg .'<div>'; }else if(isset($smsg)){echo $smsg;}; ?></p>
                 </div>
                </form>
                
            </div>
          </div>
        </div>
      </div>
    </div>
   
    </div>
    <footer class="footer bg-primary text-white">
            &copy; Redeemer's International Leadership Academy - RILA <script>document.write(new Date().getFullYear());</script> 
        </footer>

</body>
</html>
