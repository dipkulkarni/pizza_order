<?php
error_reporting(0);
	if($_POST['data'] == 'success'){
		echo "Thank You for your order. \n Your order has been successfully placed and it will be delivered in 30 minutes";
	}else{
		$order = $_POST['order']['pizza_name'];
	}
	$order = $_POST['order'];
	$obj->out = json_encode($order);
	$myfile = fopen("order.JSON", "w");
	file_put_contents("order.JSON", serialize($obj));
	fclose($myfile);
?>
