<?php
		
	// database connection
	include "config.php";

	//$con = mysqli_connect('localhost','root','getlost','online_store_manager');

	if( $_SERVER["REQUEST_METHOD"] == 'GET' ){

		$product_name = $_GET['product_name'];  // product name
		$product_price = $_GET['product_price']; // product price
		$user_id = $_GET['user_id'];
		
		
		
		$sql = "SELECT * from users where USER_ID='$user_id'";

		$result = mysqli_query($con,$sql);
		
		$row = mysqli_fetch_row($result); 
	
		if(!isset($row))
		{
			$add_result['status'] = "failed" ;
			$add_result['msg'] = "User does not exist";

			$add_result = json_encode($add_result);
			return $add_result;
		}
		
		else{	

			$type = $row[3]; // get user type


			if($type == 1){
				$sql = "INSERT INTO products(PRODUCT_NAME, ADDED_BY, DELETED_BY, IS_ACTIVE, PRICE) values('$product_name','$user_id',NULL,1,'$product_price')";
			
				mysqli_query($con,$sql);
				
				

					$add_result['status'] = "success" ;
					$add_result['msg'] = "Product inserted";

					$add_result = json_encode($add_result);
					return $add_result;
			}

			else{

				$add_result['status'] = "failed" ;
				$add_result['msg'] = "Permission Denied";

				$add_result = json_encode($add_result);
				return $add_result;
			}
 		}
	
 }

?>