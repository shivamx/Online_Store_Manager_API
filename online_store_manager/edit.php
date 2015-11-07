<?php

		
	include "config.php";

	if( mysqli_connect_errno() ){
		echo 'could not connect to database';
	}

	if( $_SERVER["REQUEST_METHOD"] == 'GET' ){

		$product_id = $_GET['product_id'];
		$user_id = $_GET['user_id'];
		
		$product_name = $_GET['product_name'];
		$price = $_GET['product_price'];

		$sql = "SELECT * from users where USER_ID='$user_id'";

		$result = mysqli_query($con,$sql);

		$row = mysqli_fetch_row($result); 

		if(!isset($row))
		{
			$edit_result['status'] = "failed" ;
			$edit_result['msg'] = "User doesn't exist";

			$edit_result = json_encode($edit_result);
			return $edit_result;
		}
		
		else{	

			$type = $row[3];

			if($type == 1){

				if(isset($product_name) && isset($price))
				$sql = "Update products SET PRODUCT_NAME = '$product_name' , PRICE= '$price' where PRODUCT_ID='$product_id'";
				
				elseif( isset($product_name) && !isset($price))
				$sql = "Update products SET PRODUCT_NAME = '$product_name'  where PRODUCT_ID='$product_id'";

				elseif( !isset($product_name) && isset($price) )
				$sql = "Update products SET PRODUCT_NAME = '$product_name' , PRICE= '$price' where PRODUCT_ID='$product_id'";

				mysqli_query($con,$sql);
			

					$edit_result['status'] = "success" ;
					$edit_result['msg'] = "Product edited";

					$edit_result = json_encode($edit_result);
					return $edit_result;
				
				
			}

			else{

				$edit_result['status'] = "failed" ;
				$edit_result['msg'] = "Permission Denied";

				$edit_result = json_encode($edit_result);
				return $edit_result;
			}
 		}

 }

?>