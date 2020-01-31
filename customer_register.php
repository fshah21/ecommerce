<!DOCTYPE>
<?php
	session_start();
	include("functions/functions.php");
?>
<html>
	<head>
		<title>Gifts</title>
		<link rel="stylesheet" href="styles/style.css"media="all">
	</head>
	<body>
		<div class="main_wrapper">
			<div class="header_wrapper">
				<a href="index.php"><img src="images/giftslogo.png" id="logo"></a>
				<div id="banner">
					<img src="images/giftsbanner.jpg" id="image">
				</div>
			</div>
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
						<input type="text" name="user_query"placeholder="Search A Product"/>
						<input type="submit" name="search" value="Search"/>
					</form>
				</div>
			</div>
			<div class="content_wrapper">
				<div id="sidebar">
					<div id="sidebar_title">Categories
						<ul id="cats">
							<?php getcats(); ?>
						</ul>
					</div>
					<div id="sidebar_title">Brands
						<ul id="cats">
							<?php getbrands(); ?>
						</ul>
					</div>
				</div>
				<div id="content_area">
					<?php cart(); ?>
					<div id="shopping_cart">
						<span style="float:right;font-size:18px;padding:5px;line-height:40px;">
							Welcome Guest! <b style="color:yellow;">Shopping Cart -</b>Total Items: <?php totitems(); ?> Total Price: <?php totprice(); ?> <a href="cart.php" style="color:yellow;">Go To Cart</a>
						</span>
					</div>
					<?php getIp(); ?>
					<form action="customer_register.php" method="post" enctype="multipart/form-data">
						<table width="800" style="text-align:center;" bgcolor="skyblue">
							<tr align="center">
								<td colspan="2" style="padding-bottom:20px;"><h2>Register to Buy!</h2></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Name:</b></td>
								<td align="left"><input type="text" name="c_name" placeholder="Enter Name" required/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Email:</b></td>
								<td align="left"><input type="text" name="c_email" placeholder="Enter Email" required/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Password:</b></td>
								<td align="left"><input type="text" name="c_password" placeholder="Enter Password" required/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Country:</b></td>
								<td align="left"><input type="text" name="c_coun" placeholder="Enter Country"/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer City:</b></td>
								<td align="left"><input type="text" name="c_city" placeholder="Enter City"/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Contact:</b></td>
								<td align="left"><input type="text" name="c_contact" placeholder="Enter Contact Number"/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Address:</b></td>
								<td align="left"><input type="text" name="c_addr" placeholder="Enter Address"/></td>
							</tr>
							<tr>
								<td align="right"><b>Customer Image:</b></td>
								<td align="left"><input type="file" name="c_image"/></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Register" name="signup"/></td>
							</tr>
						</table>
					</form>
					<h2 style="background-color:none;"><a href="customer_login.php" style="float:right;text-decoration:none;">Log In !</a></h2>
				</div>
			</div>
			<div id="footer">
				<h2 style="text-align:center;padding-top:20px;">&copy By Feya Shah</h2> 
			</div>
		</div>
	</body>
</html>
<?php
	if(isset($_POST['signup']))
	{
		$con = mysqli_connect("localhost","root","","ecommerce");
		$ip = getIp();
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_password'];
		$c_coun = $_POST['c_coun'];
		$c_city = $_POST['c_city'];
		$c_addr = $_POST['c_addr'];
		$c_contact = $_POST['c_contact'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
		$insert = "insert into customer (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_address,customer_contact,customer_image) 
		values ('$ip','$c_name','$c_email','$c_pass','$c_coun','$c_city','$c_addr','$c_contact','$c_image')";
		$run = mysqli_query($con,$insert);
		$sel_cart = "select * from cart where ip_add = '$ip'";
		$run_cart = mysqli_query($con, $sel_cart);
		$check_cart = mysqli_num_rows($run_cart);
		if($check_cart == 0)
		{
			$_SESSION['customer_email'] = $c_email;
			echo "<script>alert('Account Created')</script>";
			echo "<script>window.open('customer/my_account.php','_self')</script>";
		}
		else
		{
			$_SESSION['customer_email'] = $c_email;
			echo "<script>alert('Account Created')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
	}
?>