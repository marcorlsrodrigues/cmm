<?php

include_once('includes/db_connect.php');
	
	$sql = 'select * from cmm order by id desc limit 1';
	$stmt = $mysqli->prepare($sql);

	if ($stmt) {
        if($stmt->execute()){
            $result = $stmt->get_result();
        
            $row = $result->fetch_array(MYSQLI_ASSOC);
              
            $return = array($row);
        
            //close statement
            $stmt->close();
        }
        else{
            $return = $stmt->error;
        }
    }else{
        echo "Error STMT";
    }

    $result = [ 'status' => 'OK', 'dados' => $return];

    echo json_encode($result);
    $mysqli->close();
?>