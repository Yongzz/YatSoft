<?php
	require 'include/connect.php';
	$result = mysqli_query($con,'select * from item');
	$number = 0;


 ?>
<!DOCTYPE>
<html>
<head>
<title>
YAT Clothing Shop
</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/yat.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
</head>

<body>
<a href='YAT_Clothing_Shop.html'><img src='images/yat_logo.png'/></a>
 <center>
    <input type = 'text' size='90' name = 'search'>
    <input type = 'submit' name = 'submit' value = 'Search'></br></br>
	</br>
 </center>
<div class="container">
  <ul class="nav nav-tabs nav-justified">
    <li><a href="YAT_Clothing_Shop.html">Home</a></li>
    <li><a href="#">Women</a></li>
    <li><a href="#">Men</a></li>
    <li class="active"><a href="kids.html">Kids</a></li>
	<li><a href="shopping_cart.html">View Shopping Cart</a></li>
	<li><a href="login.html">View Order</a></li>
	<li><a href="login.html">Log in</a></li>
  </ul>
</div>
<br/>
<br/>

	
<div style="width:70%;margin-left:20%;">
	 
 	<?php while ($item = mysqli_fetch_object($result)) {?>
 			<div style="height:200px;float:left;margin-right:15px;width:150px;border-size:2px;border:1px solid black;margin-bottom:10px">
 				<div style="height:110px;width:150px;background-color:Red">
 					<?php echo '<img src="images/'.$item->item_image.'" alt="'.$item->item_image.'" style="width: 100%;max-height: 100%;" />'; ?>
 				</div>
 				<div style="height:20px;width:150px;text-align:center;background-color:white;color-white;"><?php echo  $item->item_name; ?> </div>
 				<div style="height:20px;width:150px;background-color:Green;font-size:18px;color:white;text-align:center;border-radius: 25px;">
 					<strong><?php echo "R".$item->item_price; ?></strong>
 				</div>
 				<div style="height:15px;"></div>
 				<div style="height:35px;"><a href="cart.php?id=<?php echo $item->id; ?>">Add to Cart</a></div>
 			</div>
 	<?php } ?>
</div>
<br/><br/>
<div class="footer">
<table style="width:80%">
	<tr>
		<td><a href='#'>About Us</a></td>
		<td><a href='#'>Contact Us</a></td>
		<td><a href='#'>Change Address</a></td>
	</tr>
</table>
</div>

</body>

</html>