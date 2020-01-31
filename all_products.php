<!DOCTYPE>
<?php
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
				<div id="contentarea">
					<div id="shopping_cart">
						<span style="float:right;font-size:18px;padding:5px;line-height:40px;">
							Welcome Guest! <b style="color:yellow;">Shopping Cart -</b>Total Items: Total Price: <a href="cart.php" style="color:yellow;">Go To Cart</a>
						</span>
					</div>
					<div id="products_box">
						<?php
							global $con;
							$get_pro = "select * from products order by RAND() LIMIT 0,4";
							$run_pro = mysqli_query($con,$get_pro);
							while($row_pro = mysqli_fetch_array($run_pro))
							{
								$pro_id = $row_pro['product_id'];
								$pro_cat = $row_pro['product_cat'];
								$pro_desc = $row_pro['product_desc'];
								$pro_img = $row_pro['product_image'];
								$pro_keys = $row_pro['product_keywords'];
								$pro_title = $row_pro['product_title'];
								$pro_price = $row_pro['product_price'];
								$pro_brand = $row_pro['product_brand'];
								echo "
										<div id ='single_product'>
											<h3>$pro_title</h3>
											<img src='admin_area/product_images/$pro_img' width='180px' height='180px'/>
											<p><b>Rs. $pro_price</b></p>
											<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
											<a href='index.php?pro_id=$pro_id'</a><button style='float:right;'>Add To Cart</button>
										</div> ";
							}
						?>
					</div>
				</div>
			</div>
			<div id="footer">
				<h2 style="text-align:center;padding-top:20px;">&copy By Feya Shah</h2> 
			</div>
		</div>
	</body>
</html>