<?php
require_once('db_conn.php');

$EmailID = addslashes($_REQUEST['EmailID']);
$Mobile = addslashes($_REQUEST['Mobile']);
$InstalltionType = addslashes($_REQUEST['InstalltionType']);
$ElectricityBills = addslashes($_REQUEST['ElectricityBills']);
$WhenConsumeMoreLight = addslashes(json_encode($_REQUEST['WhenConsumeMoreLight']));
$Budget = addslashes($_REQUEST['Budget']);
$Advice = addslashes($_REQUEST['Advice']);
$Polygon = addslashes(json_encode($_REQUEST['Polygon']));
$WindMills = addslashes(json_encode($_REQUEST['WindMills']));
$NoOfPanels = addslashes((int)$_REQUEST['NoOfPanels']);
$NoOfWindMills = addslashes((int)$_REQUEST['NoOfWindMills']);
$Total = addslashes($_REQUEST['Total']);
$TotalPowerGenerated = addslashes($_REQUEST['TotalPowerGenerated']);

$Created = date('Y-m-d h:i:s');
$Updated = date('Y-m-d h:i:s');

$query = "INSERT INTO `Quotation` (
			`EmailID`,
			`Mobile`,
			`InstalltionType`,
			`ElectricityBills`,
			`WhenConsumeMoreLight`,
			`Budget`,
			`Advice`,
			`Polygon`,
			`WindMills`,
			`Created`,
			`Updated`,
			`NoOfPanels`,
			`NoOfWindMills`,
			`Total`,
			`TotalPowerGenerated`
		)
		VALUES
		  (
		    '".$EmailID."',
		    '".$Mobile."',
		    '".$InstalltionType."',
		    '".$ElectricityBills."',
		    '".$WhenConsumeMoreLight."',
		    '".$Budget."',
		    '".$Advice."',
		    '".$Polygon."',
		    '".$WindMills."',
		    '".$Created."',
		    '".$Updated."',
			'".$NoOfPanels."',
			'".$NoOfWindMills."',
			'".$Total."',
			'".$TotalPowerGenerated."'
		  )";
$result = mysqli_query($link, $query);
if($result) {
	$response = array('status' => 200, 'msg' => 'SUCCESS');
} else {
	$response = array('status' => 500, 'msg' => 'ERROR');
}
echo json_encode($response); die();