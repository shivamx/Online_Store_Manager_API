<?php

		
	include "config.php";
	
	if( mysqli_connect_errno() ){
		echo 'could not connect to database';
	}

	if( $_SERVER["REQUEST_METHOD"] == 'GET' ){

		$user_id = $_GET['user_id'];
		
		$product_name = $_GET['product_name'];

		$sql = "SELECT * from users where USER_ID='$user_id'";

		$result = mysqli_query($con,$sql);

		$row = mysqli_fetch_row($result); 

		if(!isset($row))
		{
			$search_result['status'] = "failed" ;
			$search_result['msg'] = "User doesn't exist";
			$search_result['id'] = NULL;
			$search_result['name'] = NULL;
			$search_result['price'] = NULL;

			$search_result = json_encode($search_result);
			return $search_result;
		}
		
		else{	

			$type = $row[3];

			if($type == 1){

				
				$sql = "SELECT * from products where PRODUCT_NAME ='$product_name' and IS_ACTIVE=1";
				
				$result  = mysqli_query($con, $sql);

				$row = mysqli_fetch_row($result);
				
				$product_id = $row[0];
				$product_name = $row[1];
				$price = $row[4];

				$search_result['status'] = "success" ;
				$search_result['id'] = $product_id;
				$search_result['name'] = $product_name;
				$search_result['price'] = $price;

				$search_result = json_encode($search_result);
				return $search_result;

				
			}

			else{

					$search_result['status'] = "failed" ;
					$search_result['msg'] = "Permission denied";
					$search_result['id'] = NULL;
					$search_result['name'] = NULL;
					$search_result['price'] = NULL;

					$search_result = json_encode($search_result);
					return $search_result;
			}
 		}

 }

?>