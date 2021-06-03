<?php

require_once '../../core/init.php';

$payment_id = $_POST['payment_id'];

if (Input::exists()) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'member_id'     => array(
            'required'      =>  true,
            'min'           =>  6,
            'max'           =>  11
            ),

            'matric_no'     => array(
            'require'       => true
            ),

            'payment_type'  => array(
            'require'       => true
            ),

            'amount'        => array(
            'require'       => true
            ),

            'paid'          => array(
            'require'       => true,
            ),
            'added_by'      =>  array(
            'required'      =>  true,
            )
        ));

        if ($validation->passed()) {
            $user = Db::getInstance();

            try {
                    $user->update('payment', $payment_id, array(
                        'member_id' => Input::get('member_id'),
                        'matric_no' => Input::get('matric_no'),
                        'payment_type' => Input::get('payment_type'),
                        'amount' => Input::get('amount'),
                        'paid' => Input::get('paid'),
                        'added_by' => Input::get('added_by')
                    ));

                    echo 'You have successfully registered a student';
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
        }
    }



