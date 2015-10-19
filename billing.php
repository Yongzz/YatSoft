<?php
	/*if($_REQUEST['command']=='update'){
		$name=$_REQUEST['name'];

		$phone=$_REQUEST['phone'];
		/*
		$result=mysql_query("insert into customers values('','$name','$email','$address','$phone')");
		$customerid=mysql_insert_id();
		$date=date('Y-m-d');
		$result=mysql_query("insert into orders values('','$date','$customerid')");
		$orderid=mysql_insert_id();
		
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			mysql_query("insert into order_detail values ($orderid,$pid,$q,$price)");
		}
		die('Thank You! your order has been placed!');
	}*/
?>
<?php

require('include/connect.php');
require('classes/item.php');
session_start();
if(isset($_REQUEST['command']) && $_REQUEST['command']=='update')
{   
	$email = mysqli_real_escape_string($con,$_REQUEST['email']);
    $password = mysqli_real_escape_string($con,$_REQUEST['password']);
   
	/*if(!$_REQUEST['email'] | !$_REQUEST['password']){
		echo("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('you did not complete all the details')
			window.location.href = 'login.html'
			</SCRIPT>");
			exit();
	}*/
	
        $results = mysqli_query($con,"select * from customer where Email_Address='".$email."' and Password='".$password."'");

    	$user = mysqli_fetch_object($results);  

        if(mysqli_num_rows($results)>0)
        {
        	$random = time().rand(10*45, 100*98);
        	$sum = 0;
        	$cart = unserialize(serialize($_SESSION['mycart']));
        	for ($i=0; $i <count($cart); $i++)
        	{
        		$sum +=   $cart[$i]->getQuantity()* $cart[$i]->getPrice();
        		mysqli_query($con, "INSERT INTO tbl_order (Order_Date, Cust_No,Reference_No) VALUES (CURDATE(),".$user->Cust_No.",".$random.")");
        		$id = mysqli_insert_id($con);
        		mysqli_query($con, "INSERT INTO orderline (Order_No,item_no,quantity) VALUES (".$id.",".$cart[$i]->getId().",".$cart[$i]->getQuantity().")");
				$ol_no = mysqli_insert_id($con);
       			mysqli_query($con, "INSERT INTO invoice (OL_No,Total_Amount,Inv_Date) VALUES (".$ol_no.",".$sum.",CURDATE())");
       			$invoice_no = mysqli_insert_id($con);
       			mysqli_query($con, "INSERT INTO delivery_invoice ( Cust_No,Inv_No,Inv_Date) VALUES (".$user->Cust_No.",".$invoice_no.",CURDATE())");

        	}


        	//$_SESSION['login_user']=$email;
        	$_SESSION['mycart'] = array();

			die('<h1 style ="color:red;text-align:center;">Thank You! your order has been placed!<h1>');
        }
		else{
		echo("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('invalid username or password, please re-enter')
			window.location.href = 'billing.php'
			</SCRIPT>");
			
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Billing Info</title>
<script language="javascript">
	function validate(){
		var f=document.form1;
		if(f.email.value=='' && f.password.value ==''){
			alert('Your name is required');
			f.email.focus();
			return false;
		}
		f.command.value='update';
		f.submit();
	}
</script>
</head>
<body>
<form name="form1" onsubmit="return validate()">
    <input type="hidden" name="command" />
    <div align="center">
	<div  style="border: 5px solid #FF1919;-moz-border-radius-bottomright: 60px;-moz-border-radius-bottomleft: 60px;border-bottom-right-radius: 60px;border-bottom-left-radius: 60px;background-color:#1ABC9C;width:32%;margin:8%;">
        <h1 align="center">Billing Info</h1>
        <table border="0" cellpadding="2px">
        	<tr><td>Order Total:</td><td></td></tr>
            <tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
            <tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" value="Place Order" /></td><td><a href="">Register?</a></td></tr>
        </table>
	</div>
	</div>
</form>
</body>
</html>
