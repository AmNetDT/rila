<?php 
ini_set('max_execution_time', 0);
	require '../../dbconfig/db.php';
	require '../../query/users.php';
	
	$db   = new db();
	$conn = $db->connect();

	$employee_id = $_POST['employee_id'];
	$fname_i_u = $_POST['fname_i_u'];
	$middlename_u_i = $_POST['middlename_u_i'];
	$lastname_u_i = $_POST['lastname_u_i'];
	$sex_u_i = $_POST['sex_u_i'];
	$phoneno_u_i = $_POST['phoneno_u_i'];
	$email_u_i = $_POST['email_u_i'];
	$phonefacode_u_i = $_POST['phonefacode_u_i'];
	$bikefacode_u_i = $_POST['bikefacode_u_i'];
	$phoneimie_u_i = $_POST['phoneimie_u_i'];
	$devicebrands_u_i = $_POST['devicebrands_u_i'];
	$custcode_u_i = $_POST['custcode_u_i'];
	$edcode_u_i = $_POST['edcode_u_i'];
	$depots_u_id = $_POST['depots_u_id'];
	$businessunit_u_i = $_POST['businessunit_u_i'];
	$distchannel_u_i = $_POST['distchannel_u_i'];
	$region_u_i = $_POST['region_u_i'];
	$area_u_i = $_POST['area_u_i'];
	$syscat_u_i = $_POST['syscat_u_i'];
	$password_u_i = $_POST['password_u_i'];
	$depotwaiver_u_i = $_POST['depotwaiver_u_i'];
	$activate_u_i = $_POST['activate_u_i'];

	$stm = $conn->prepare (DbQuery::usersInfoUpdates());
	$stm->execute(array($fname_i_u,  $middlename_u_i, $lastname_u_i, $sex_u_i, $phoneno_u_i, $email_u_i, 
	$phonefacode_u_i, $bikefacode_u_i, $phoneimie_u_i, $devicebrands_u_i, $custcode_u_i, $edcode_u_i,
	$depots_u_id, $distchannel_u_i, $region_u_i, $area_u_i, $syscat_u_i, $password_u_i, $depotwaiver_u_i, $activate_u_i,
	$employee_id));

	$json =array(
		"status"=>200,
		"msg"=>"Registration Successful"
	);

  echo json_encode($json);
?>
