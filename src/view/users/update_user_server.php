<?php

require_once '../../core/init.php';

$id = $_POST['user_id'];

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
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

        if ($validation->passed()) {
            $user = Db::getInstance();
            $salt = Hash::salt(32);

            try {
                $user->update("users", $id, array(
                    'username' => Input::get('username'),
                    'syscategory' => Input::get('syscategory'),
                    'school' => Input::get('school'),
                    'location' => Input::get('location'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'joined' => date('Y-m-d H:i:s')
                ));
                echo 'You have successfully registered';
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
        }
    }
}