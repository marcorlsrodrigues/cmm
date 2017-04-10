<?php

include_once('includes/db_connect.php');

if(isset($_POST['degree'],$_POST['level'],$_POST['power'])){
	$degree = $_POST['degree'];
	$level=$_POST['level'];
    $power=$_POST['power'];
	$device_id=$_POST['device_id'];
	
	$sql_insert = "insert into cmm(date,temperature,level,power,device_id) values (now(),?,?,?,?)";
	$stmt = $mysqli->prepare($sql_insert);
	$stmt->bind_param('diii',$degree,$level,$power,$device_id);

	if ($stmt) {
        if($stmt->execute()){
            $return = [ 'status' => 'OK'];
        }
        else{
            $return = [ 'status' => 'ERROR','dados'=>$stmt->error];
        }
    }else{
        $return = [ 'status' => 'ERROR','dados'=>'Error STMT'];
    }

    echo json_encode($return);

    $mysql_close = mysqli_close($mysqli);
}else{
    $return = [ 'status' => 'ERROR','dados'=>'Post variables not set'];
    echo json_encode($return);
}

?>