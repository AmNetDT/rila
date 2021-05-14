<?php
include('../../core/db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM students_record ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE firstname LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR school LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="view/students/upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["matric_no"];
	$sub_array[] = $row["firstname"] ." ". $row["lastname"];
	$sub_array[] = $row["school"];
	$sub_array[] = $row["location"];
	$sub_array[] = $row["created"];
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-default border p-1 update"><span class="fa fa-search"></span></button><button type="button" name="delete" id="'.$row["id"].'" class="btn btn-default border p-1 delete"><span class="fa fa-trash"></span></button>';
	
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>