<?php
error_reporting(0);
	if($_POST['data'] == 'success'){
		echo "You have successfully placed your order and it will be delivered in 30 minutes";
	}else{
		$order = $_POST['order']; 
	}
?>
