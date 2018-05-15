<?php
require_once('db_conn.php');

$EmailID = addslashes($_REQUEST['EmailID']);
$Mobile = addslashes($_REQUEST['Mobile']);
$Name = addslashes($_REQUEST['Name']);
$Password = addslashes($_REQUEST['Password']);
$Created = date('Y-m-d h:i:s');
$Updated = date('Y-m-d h:i:s');

$query = "INSERT INTO `user` (
			  `Name`,
			  `EmailID`,
			  `Password`,
			  `Mobile`,
			  `Created`,
			  `Updated`
			)
			VALUES
			  (
			    '".$Name."',
			    '".$EmailID."',
			    '".md5($Password)."',
			    '".$Mobile."',
			    '".$Created."',
			    '".$Updated."'
			  )";
$result = mysqli_query($link, $query);
if($result) {
	$response = array('status' => 200, 'msg' => 'SUCCESS');
} else {
	$response = array('status' => 500, 'msg' => 'ERROR');
}
echo json_encode($response); die();