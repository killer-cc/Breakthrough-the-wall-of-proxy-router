<?php
	require_once("sql.php");
	$conn = connectSQL();
	$action = $_GET["action"];

	if ($action == "getDatas"){
		$sql1 = "SELECT * FROM domains";
		$sql2 = "SELECT * FROM ips";
		$domain = getresultSQL($conn,$sql1);
		$ip = getresultSQL($conn,$sql2);
		echo json_encode(array("domain"=>$domain,"ip"=>$ip));
	}else if ($action == "addData"){
		if ($_POST["type"] == "domain"){
			$sql = "INSERT INTO `domains` (domain) VALUES ('". $_POST["server"] ."')";
		}else{
			$sql = "INSERT INTO `ips` (ip) VALUES ('". $_POST["server"] ."')";
		}
		if (mysqli_query($conn,$sql)){
			echo json_encode(array("status"=>"done"));
		}else{
			echo json_encode(array("status"=>"exist"));
		}
	}

	disconnectSQL($conn);
?>
