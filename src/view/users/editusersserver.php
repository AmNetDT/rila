<?php 
require_once '../../core/init.php';

$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('../../login/index');
}

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
                        	$json =array(
								"status"=>200,
								"msg"=>"User created Successful"
							);


                    }catch(Exception $e){
                        die($e->getMessage());
                    }

             }else{

                  foreach($validation->errors() as $error){
                      $json =array(
						"status"=>404,
						"msg"=>"User creation failed"
					);
                  }

             }
              
          }
        }


  echo json_encode($json);
?>
