<!DOCTYPE>
<?php 
session_start(); 

include("functions/functions.php");
	$con = mysqli_connect("localhost","root","","ecommerce");
	
					
					
					//if(isset($_SESSION['qty']))
					//{
						//echo "<script>alert('How are you ');</script>";
						//$_SESSION['qty'] = $product_qty;
						//echo "<script>alert($product_qty);</script>";
					//}
			
			
?>
<html>
	<head>
		<title>My Online Shop</title>
		
		
	<link rel="stylesheet" href="styles/style.css" media="all" /> 
	</head>
	
<body>
	
	<!--Main Container starts here-->
	<div class="main_wrapper">
	
		<!--Header starts here-->
		
		
			<div class="header_wrapper">
				<a href="index.php"><img src="images/giftslogo.png" id="logo"></a>
				<div id="banner">
					<img src="images/giftsbanner.jpg" id="image">
				</div>
			</div>
		<!--Header ends here-->
		
		<!--Navigation Bar starts-->
		<div class="menubar">
				<ul>
					<li class="menuli"><a href="index.php" class="menulia">Home</a></li>
					<li class="menuli"><a href="all_products.php" class="menulia">All Products</a></li>
					<li class="menuli"><a href="customer/my_account.php" class="menulia">Account</a></li>
					<li class="menuli"><a href="#" class="menulia">Sign Up</a></li>
					<li class="menuli"><a href="cart.php" class="menulia">Shopping Cart</a></li>
					<li class="menuli"><a href="#" class="menulia">Contact Us</a></li>
				</ul>
			
			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a Product"/ > 
					<input type="submit" name="search" value="Search" />
				</form>
			
			</div>
			
		</div>
		<!--Navigation Bar ends-->
	
		<!--Content wrapper starts-->
		<div class="content_wrapper">
		
			<div id="sidebar">
			
				<div id="sidebar_title">Categories</div>
				
				<ul id="cats">
				
				<?php getCats(); ?>
				
				<ul>
					
				<div id="sidebar_title">Brands</div>
				
				<ul id="cats">
					
					<?php getBrands(); ?>
				
				<ul>
			
			
			</div>
		
			<div id="content_area">
			
			<?php cart(); ?>
			
			<div id="shopping_cart"> 
					
					<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
					
					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
					
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php totitems();?> Total Price: <?php totprice(); ?> <a href="index.php" style="color:yellow">Back to Shop</a>
					
					<?php 
					if(!isset($_SESSION['customer_email'])){
					
					echo "<a href='checkout.php' style='color:orange;'>Login</a>";
					
					}
					else {
					echo "<a href='logout.php' style='color:orange;'>Logout</a>";
					}
					
					
					
					?>
					
					</span>
			</div>
			
				<div id="products_box">
				
			<form action="" method="post" enctype="multipart/form-data">
			
				<table align="center" width="700" bgcolor="skyblue">
					
					<tr align="center">
						<th>Remove</th>
						<th>Product(S)</th>
						<th>Total Price</th>
					</tr>
					
		<?php 
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			
			$product_title = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image']; 
			
			$single_price = $pp_price['product_price'];
			
			$values = array_sum($product_price); 
			
			$total += $values; 
					
					?>
					
					<tr align="center">
						<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
						<td><?php echo $product_title; ?><br>
						<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
						</td>
						<td><?php echo "$" . $single_price; ?></td>
					</tr>
			
		<?php			
		}}
			?>
				<tr>
						<td colspan="3" align="right"><b>Sub Total:</b></td>
						<td><?php echo "$" . $total;?></td>
					</tr>
					
					<tr align="center">
						<td colspan="2"><input type="submit" name="update_cart" onclick="setVal();" value="Update Cart"/></td>
						<td><input type="submit" name="continue" value="Continue Shopping" /></td>
						<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
					</tr>
					
				</table> 
			
			</form>
			
	<?php 
		
	function updatecart(){
		
		global $con; 
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])){
		
			foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
			
			$run_delete = mysqli_query($con, $delete_product); 
			
			if($run_delete){
			
			echo "<script>window.open('cart.php','_self')</script>";
			
			}
			
			}
		
		}
		if(isset($_POST['continue'])){
		
		echo "<script>window.open('index.php','_self')</script>";
		
		}
	
	}
	echo @$up_cart = updatecart();
	
	?>

				
				</div>
			
			</div>
		</div>
		<!--Content wrapper ends-->
		
		
		
		<div id="footer">
		
		<h2 style="text-align:center; padding-top:30px;">&copy; 2014 by www.OnlineTuting.com</h2>
		
		</div>
	
	
	
	
	
	
	</div> 
<!--Main Container ends here-->


</body>
</html>