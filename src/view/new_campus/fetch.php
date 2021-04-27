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
