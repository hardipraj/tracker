<?php
 
 	include 'DBConfig.php';
	$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
	
// Path to move uploaded files
$target_path = "uploads/";
 
// array for final json respone
$response = array();
 
// getting server ip address
$server_ip = gethostbyname(gethostname());
 
// final file url that is being uploaded
$file_upload_url = 'http://' . $server_ip . '/' . 'tracker' . '/' . $target_path;

    $o_i = null;
	$p_n = null;
	$v_n = null;
	$i_d = null;
    $p_l = null;
	$i_l = null;
 
if (isset($_POST['o_i'])) {
    $target_path1 = $target_path . basename($_FILES['person']['name']);
	$target_path2 = $target_path . basename($_FILES['item']['name']);
 
    // reading other post parameters
    $o_i = isset($_POST['o_i']) ? $_POST['o_i'] : '';
	$p_n = isset($_POST['p_n']) ? $_POST['p_n'] : '';
	$v_n = isset($_POST['v_n']) ? $_POST['v_n'] : '';
	$i_d = isset($_POST['i_d']) ? $_POST['i_d'] : '';
    $p_l = $file_upload_url . basename($_FILES['person']['name']);
	$i_l = $file_upload_url . basename($_FILES['item']['name']);
 

	
    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['person']['tmp_name'], $target_path1)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }
        // File successfully uploaded
        $response['message'] = 'File uploaded successfully!';
		if (!move_uploaded_file($_FILES['item']['tmp_name'], $target_path2)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }
        // File successfully uploaded
        $response['message'] = 'File uploaded successfully!';
    } catch (Exception $e) {
        // Exception occurred. Make error flag true
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
	
	$query = "insert into user_data (order_id, person_name, vehicle_no, item_desc,person_link,item_link) values ('$o_i', '$p_n', '$v_n', '$i_d','$p_l','$i_l')";
	$inserted = mysqli_query($con, $query);
	
	/*
	try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['item']['tmp_name'], $target_path2)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }
        // File successfully uploaded
        $response['message'] = 'File uploaded successfully!';
    } catch (Exception $e) {
        // Exception occurred. Make error flag true
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }*/
} else {
    // File parameter is missing
	$response['error'] = true;
    $response['message'] = 'Not received any file!';
}

	      
 
// Echo final json response to client
echo json_encode($response);
?>