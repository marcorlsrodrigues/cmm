<?php

include_once('includes/db_connect.php');

if(isset($_POST['degree'],$_POST['level'])){
	$degree = $_POST['degree'];
	$level=$_POST['level'];
	
	$sql_insert = "insert into cmm(date,temperature,level) values (now(),?,?)";
	$stmt = $mysqli->prepare($sql_insert);
	$stmt->bind_param('di',$degree,$level);

	if ($stmt) {
        if($stmt->execute()){
            $return = "ok";
        }
        else{
            $return = $stmt->error;
        }
    }else{
        echo "Error STMT";
    }

    echo json_encode($return);

    $mysql_close = mysqli_close($mysqli);
}else{
    echo "Post variables not set!";
}

?>