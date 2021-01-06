<?php
	function connectSQL(){
		$server = "localhost";
	        $username = "proxy";
	        $password = "group10";
	        $dbname = $username;

		$conn = mysqli_connect($server,$username,$password,$dbname);
		return $conn;
	}
	
	function disconnectSQL($conn){
		mysqli_close($conn);
	}
	
	function getresultSQL($conn,$sql){
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 0){
			return NULL;			//return NULL if $result is Empty.
		}else{
			$result_array = array();
			while ($row = mysqli_fetch_assoc($result)){
				$result_array[count($result_array)] = $row;
			}
			return $result_array;	//return array for the result of $sql;
		}
	}
?>
