<?php
include('../../core/db.php');
include('function.php');

if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM students_record 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["matric_no"] = $row["matric_no"];
		$output["firstname"] = $row["firstname"];
		$output["lastname"] = $row["lastname"];
		$output["othername"] = $row["othername"];
		$output["date_of_Birth"] = $row["date_of_Birth"];
		$output["place_of_Birth"] = $row["place_of_Birth"];
		$output["nationality"] = $row["nationality"];
		$output["state_of_origin"] = $row["state_of_origin"];
		$output["LGA"] = $row["LGA"];
		$output["marital"] = $row["marital"];
		$output["spouse_name"] = $row["spouse_name"];
		$output["maiden_name"] = $row["maiden_name"];
		$output["date_married"] = $row["date_married"];
		$output["no_of_children"] = $row["no_of_children"];
		$output["phone"] = $row["phone"];
		$output["email"] = $row["email"];
		$output["school"] = $row["school"];
		$output["location"] = $row["location"];
		$output["course_duration"] = $row["course_duration"];
		$output["added_by"] = $row["added_by"];
		$output["created"] = $row["created"];
		$output["modified"] = $row["modified"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>
    