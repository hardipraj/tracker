<?php

	include 'DBConfig.php';
	$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $order_id = "";
    $person_name = "";
    $vehicle_no = "";
	$item_desc = "";
    
    if(isset($_POST['order_id'])){
        $order_id = $_POST['order_id'];
    }
    
    if(isset($_POST['person_name'])){
        $person_name = $_POST['person_name'];
    }
    
    if(isset($_POST['vehicle_no'])){
        $vehicle_no = $_POST['vehicle_no'];
    }
	
	if(isset($_POST['item_desc'])){
        $item_desc = $_POST['item_desc'];
        
    }
	
	if(isset($_POST['person_image_link'])){
        $person_link = $_POST['person_image_link'];
        
    }

	//$query = "insert into user_data (order_id, person_name, vehicle_no, item_desc) values ('abc', 'abc', 'abc', 'abc')";
    $query = "insert into user_data (order_id, person_name, vehicle_no, item_desc,person_link) values ('$order_id', '$person_name', '$vehicle_no', '$item_desc','$per')";         
	$inserted = mysqli_query($con, $query);      
	if($inserted == 1){
		
		$json['success'] = 1;
		$json['message'] = "Successfully registered the user";
		
	}else{
		
		$json['success'] = 0;
		$json['message'] = "Error in registering. Probably the username/email already exists";
		
	}
	echo json_encode($json);
?>