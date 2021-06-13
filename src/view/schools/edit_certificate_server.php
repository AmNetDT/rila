<?php

require_once '../../core/init.php';

$id = $_POST['id'];

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'title'         => array(
        'required'      => true
        ),
        'duration'      => array(
        'required'      => true
        ),
        'added_by'      =>  array(
        'required'      =>  true
        )
    ));

    if ($validation->passed()) {
        $user = Db::getInstance();

        try {
            $user->update('certificates', $id, array(
                'title'     => Input::get('title'),
                'duration'  => Input::get('duration'),
                'added_by'  => Input::get('added_by')
            ));

            echo 'Programme added successfully';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {

        foreach ($validation->errors() as $error) {
            echo $error . '<br />';
        }
    }
}
