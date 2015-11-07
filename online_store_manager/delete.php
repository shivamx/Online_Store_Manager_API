<?php

		
	include "config.php";

	if( mysqli_connect_errno() ){
		echo 'could not connect to database';
	}

	if( $_SERVER["REQUEST_METHOD"] == 'GET' ){

		$product_id = $_GET['product_id'];
		$user_id = $_GET['user_id'];

		$sql = "SELECT * from users where USER_ID='$user_id'";

		$result = mysqli_query($con,$sql);

		$row = mysqli_fetch_row($result); 

		if(!isset($row))
		{
			$del_result['status'] = "failed" ;
			$del_result['msg'] = "User doesn't exist";

			$del_result = json_encode($del_result);
			return $del_result;
		}
		
		else{	

			$type = $row[3];

			if($type == 1){

				$sql = "Update products SET DELETED_BY = '$user_id' , IS_ACTIVE = 0 where PRODUCT_ID='$product_id'";
	
				mysqli_query($con,$sql);
			
				
						$del_result['status'] = "success" ;
						$del_result['msg'] = "Product deleted";

						$del_result = json_encode($del_result);
						return $del_result;
				
				
			}

			else{

					$del_result['status'] = "failed" ;
					$del_result['msg'] = "Permission denied";

					$del_result = json_encode($del_result);
					return $del_result;
			}
 		}

 }

?>