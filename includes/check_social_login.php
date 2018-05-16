<?php
require_once('db_conn.php');

$EmailID = addslashes($_REQUEST['EmailID']);

$query = "SELECT * FROM user WHERE EmailID = '".$EmailID."' AND Deleted = 0";
$result = mysqli_query($link, $query);
$response = array();
if(mysqli_num_rows( $result )) {
	$row = mysqli_fetch_assoc($result);
	@session_start();
	$_SESSION['user_id'] = $row['ID'];
	$_SESSION['user_email'] = $row['EmailID'];
	$_SESSION['user_name'] = $row['Name'];
	$response = array('status' => 200, 'msg' => 'Login is Successful');
} else {
	$response = array('status' => 500, 'msg' => 'Wrong email id or password');
}
echo json_encode($response); die();