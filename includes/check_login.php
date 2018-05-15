<?php
require_once('db_conn.php');

$EmailID = addslashes($_REQUEST['EmailID']);
$Password = addslashes($_REQUEST['Password']);

$query = "SELECT * FROM user WHERE EmailID = '".$EmailID."' AND Password = '".md5($Password)."' AND Deleted = 0";
$result = mysqli_query($link, $query);
$response = array();
if(mysqli_num_rows( $result )) {
	$response = array('status' => 200, 'msg' => 'Login is Successful');
} else {
	$response = array('status' => 500, 'msg' => 'Wrong email id or password');
}
echo json_encode($response); die();