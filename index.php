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
							<?php
								if(!isset($_SESSION['customer_email']))
								{
									echo "<a href='checkout.php' style='color:orange;'>Login</a>";
								}
								else
								{
									echo "<a href='logout.php' style='color:white;'>Logout</a>";
								}
							?>
						</span>
					</div>
					<?php getIp(); ?>
					<div id="products_box">
						<?php getpro(); ?>
						<?php getcatpro();?>
						<?php getbrandpro();?>
					</div>
				</div>
			</div>
			<div id="footer">
				<h2 style="text-align:center;padding-top:20px;">&copy By Feya Shah</h2> 
			</div>
		</div>
	</body>
</html>