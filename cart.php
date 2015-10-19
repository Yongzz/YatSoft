<?php
require 'classes/item.php';
require 'include/connect.php';
session_start();	

if(isset($_GET['id']))
{
    $result = mysqli_query($con,'select * from item where id='.$_GET['id']);
    $value = mysqli_query($con,'SELECT item_quantity FROM item WHERE id='.$_GET['id']);
    $product = mysqli_fetch_object($result);
    ;

    while ($value_row = mysqli_fetch_assoc($value)) {
      $quantityValue = (int)$value_row['item_quantity'];
    }
	   $item = new item();
    $item->setId($product->id);
    $item->setName($product->item_name);
    $item->setPrice($product->item_price);
    $item->setDescription($product->Item_description);
    $item->setQuantity(1);
    $item->setImage($product->item_image);
    $id = $item->getId();

    $index = -1;
    $cart = unserialize(serialize($_SESSION['mycart']));
    if($item->getQuantity() <= $quantityValue)
    {
      for ($i=0; $i <count($cart); $i++)
          if ($cart[$i]->getId()==$_GET['id']) {

              $index = $i;
              break;
          }
      if ($index==-1) {
              $_SESSION['mycart'][]=$item;
      }
      else 
      {
        if($cart[$index]->getQuantity() < $quantityValue)
        {
              $cart[$index]->setQuantity($cart[$index]->getQuantity()+1);
              $_SESSION['mycart']=$cart;
            }
      }
  }
    
}
if(isset($_REQUEST['command']) && $_REQUEST['command']=='clear')
{
    $_SESSION['mycart'] = Array();
    //unset($_SESSION['mycart']);
}
if (isset($_GET['index'])) {
    $cart = unserialize(serialize($_SESSION['mycart']));    
    unset($cart[$_GET['index']]);
    $cart = array_values($cart);
    $_SESSION['mycart']=$cart;
}
if (isset($_GET['iindex'])) {
    $cart = unserialize(serialize($_SESSION['mycart'])); 
    if($cart[$_GET['iindex']]->getQuantity()==1){
        unset($cart[$_GET['iindex']]);
        $cart = array_values($cart);
    } 
    else{
    $cart[$_GET['iindex']]->setQuantity($cart[$_GET['iindex']]->getQuantity()-1);
    }
    $_SESSION['mycart']=$cart;
}
 ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Shopping Cart </title>
  <script language="javascript">
  function clear_cart(){
    if(confirm('This will empty your shopping cart, continue?')){
      document.form1.command.value='clear';
      document.form1.submit();
    }
  }
  function checkout_cart(){
    if(confirm('This will empty your shopping cart, continue?')){
      document.form1.command.value='clear';
      document.form1.submit();
    }
  }
</script>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  
  <style>

body{
  font:1.2em normal Arial,sans-serif;
  color:#34495E;
}

h1{
  text-align:center;
  text-transform:uppercase;
  letter-spacing:-2px;
  font-size:2.5em;
  margin:20px 0;
}

.container{
  width:90%;
  margin:auto;
}

table{
  border-collapse:collapse;
  width:100%;
}

.blue{
  border:2px solid #1ABC9C;
}

.blue thead{
  background:#1ABC9C;
}

thead{
  color:white;
}

th {
    background-color: #1ABC9C;
  text-align:left;
  padding:5px 0;
}

tbody tr:nth-child(even){
  background:#ECF0F1;
}

tbody tr:hover{
background:#BDC3C7;
  color:#FFFFFF;
}

.fixed{
  top:0;
  position:fixed;
  width:auto;
  display:none;
  border:none;
}

.scrollMore{
  margin-top:600px;
}

.up{
  cursor:pointer;
}

</style>

</head>

<body>
<form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command"/>
<div style="margin:7%">
    <h1>Shopping Cart</h1>
 <table class="blue">
    <tr>
        <th>Delete</th>
        <th>Reduce</th>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Image</th>
        <th>Sub Total</th>
    </tr>

    <?php   
        $cart = unserialize(serialize($_SESSION['mycart']));
        $sum = 0; 
        $totalQuantity = 0;
        $index = 0;
        $iindex = 0;
        for ($i=0; $i <count($cart); $i++) { 
            $sum +=   $cart[$i]->getQuantity()* $cart[$i]->getPrice();
            $totalQuantity += $cart[$i]->getQuantity();
             ?>

        <tr>
            <td align="center"><a href="cart.php?index=<?php echo $index; ?>"&action=delete onClick="return confirm('Are you sure?')"><img src="images/remove.png" alt="Mountain View" ></a></td>
            <td><a href="cart.php?iindex=<?php echo $iindex; ?>">reduce</a></td>
            <td><?php echo $cart[$i]->getId();  ?></td>
            <td><?php echo $cart[$i]->getName();  ?></td>
            <td><?php echo $cart[$i]->getPrice();  ?></td>
            <td><?php echo $cart[$i]->getDescription();  ?></td>
            <td><?php echo $cart[$i]->getQuantity();  ?></td>
            <td><?php echo $cart[$i]->getImage();  ?></td>
            <td><?php echo  $cart[$i]->getQuantity()* $cart[$i]->getPrice();  ?></td>
           
        </tr>
        
    <?php 
        $index++;
        $iindex++;
     }
     ?>
     <tr></tr>
    <tr>
        <td colspan="6" align="right"style="font-weight:bold">Total Quantity</td>
        <td align="center" style="font-weight:bold"><?php echo $totalQuantity; ?> </td>
        <td align="right" style="font-weight:bold">Total Price</td>
        
        <td align="center"  style="font-weight:bold"><?php echo $sum; ?> </td>
    </tr>
 </table>
 <br>
 
 <br>
 <div><input type="button" value="Place Order" onclick="window.location='billing.php'">&nbsp;<input type="button" value="Clear Cart" onclick="clear_cart()">&nbsp;<a href="index.php">continue shoping</a></div>
</div>
</form>
</body>
</html>



