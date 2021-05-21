<?php

require_once '../core/db.php';


	$syscategory = $_POST['syscategory'];
	$id = $_POST['_id'];
	$member_id = $_POST['member_id'];
	
		$del = "DELETE FROM `user` WHERE `id` = $id";
		$query = $connection->prepare($del, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		if ($query->execute(array($id))) {
			if($syscategory != 5){

		$del = "DELETE FROM `staff_record` WHERE `member_id` = '$member_id'";

			}else{

		$del = "DELETE FROM `students_record` WHERE `member_id` = '$member_id'";
			}
		
			echo "Successfully Deleted";
		} else {
			echo "Failed to Delete";
		}


		

