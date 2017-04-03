<?php

include_once('includes/db_connect.php');

if(isset($_POST['degree'],$_POST['level'],$_POST['power'])){
	$degree = $_POST['degree'];
	$level=$_POST['level'];
    $power=$_POST['power'];
	
	$sql_insert = "insert into cmm(date,temperature,level,power) values (now(),?,?,?)";
	$stmt = $mysqli->prepare($sql_insert);
	$stmt->bind_param('dii',$degree,$level,$power);

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