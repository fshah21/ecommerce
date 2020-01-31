<?php
	session_start();
	include('functions/functions.php')
?>
<div>
	<form method="post" action="">
		<table width="800" style="text-align:center;" bgcolor="skyblue">
			<tr align="center">
				<td colspan="2"><h2>Login Or Register to Buy!</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Email:</b></td>
				<td align="left"><input type="text" name="email" placeholder="Enter Email" required /></td>
			</tr>
			<tr>
				<td align="right"><b>Password:</b></td>
				<td align="left"><input type="text" name="password" placeholder="Enter Password" required /></td>
			</tr>
			<tr align="center">
				<td><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Log In" name="login"/></td>
			</tr>
		</table> 
		<h2><a href="customer_register.php" style="float:right;text-decoration:none;">New ? Register Here !</a></h2>
	</form>
	<?php
		if(isset($_POST['login']))
		{
			$con = mysqli_connect("localhost","root","","ecommerce");
			$c_email = $_POST['email'];
			$c_pass = $_POST['password'];
			$ip = getIp();
			$sel_c = "select * from customer where customer_email = '$c_email' and customer_pass = '$c_pass'";
			$run_c = mysqli_query($con,$sel_c);
			$check_c = mysqli_num_rows($run_c);
			if($check_c == 0)
			{
				echo "<script>alert('Password or email entered in incorrect. Please try again.')</script>";
				exit();
			}
			$sel_cart = "select * from cart where ip_add = '$ip'";
			$run_cart = mysqli_query($con, $sel_cart);
			$check_cart = mysqli_num_rows($run_cart);
			if($check_c > 0 and check_cart == 0 )
			{
				$_SESSION['customer_email'] = $c_email;
				echo "<script>alert('Logged In Successfully')</script>";
				echo "<script>window.open('customer/my_account.php','_self')</script>";				
			}
			else
			{
				$_SESSION['customer_email'] = $c_email;
				echo "<script>alert('Logged In Successfully')</script>";
				echo "<script>window.open('checkout.php')</script>";				
			}
		}
	?>
</div>