<?php 

 	include 'DBConfig.php';
	$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query

	$stmt = $con->prepare("SELECT * FROM user_data;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($o_i, $p_n, $v_n, $i_d, $p_l, $i_l);
	
	$products = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['order_id'] = $o_i; 
		$temp['person_name'] = $p_n; 
		$temp['vehicle_no'] = $v_n; 
		$temp['item_desc'] = $i_d; 
		$temp['person_link'] = $p_l; 
		$temp['item_link'] = $i_l; 
		array_push($products, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($products);

?>