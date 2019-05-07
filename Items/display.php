<?php 
include_once("Database/connection.php");
include_once("checkout.php");

	
 ?>
	<?php 
		if(isset($_POST["click_me"])){
			 $cardNo   = mysqli_real_escape_string($conn,strip_tags($_POST['cardNo']));
			 $E = $customer_array[$key]["Email"];
			$sql=("INSERT INTO payment(Order_no,CardNumber,Payment,Email) 
				VALUES ('$order_Id','$cardNo','$total','$E')");
			$get=mysqli_query($conn,$sql)or die("error getting");

		}
	 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Thankyou For Shopping</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
</head>
<body>

<div class="super_container">


	
	<div class="checkout">
		<div class="container">
			<div class="row">

				<!-- Billing Info -->

				<div class="col-lg-6">
					<div class="billing checkout_section">
						<div  id="shop" class="section_title">Thankyou For Shopping</div>
						<div class="section_subtitle">Your Information</div>
						<div class="checkout_form_container">
							
							<form id="checkout_form" class="checkout_form">
								<div class="row">
									
									
									
									<div class="col-xl-6">
										<!-- Name -->
										<label for="checkout_name">First Name</label>
										<input type="text" id="checkout_name" class="checkout_input" required="required" value = "<?php echo $customer_array[$key]["Fname"];?>" readonly>
									</div>
									<div class="col-xl-6 last_name_col">
										<!-- Last Name -->
										<label for="checkout_last_name">Last Name</label>
										<input type="text" id="checkout_last_name" class="checkout_input" required="required" value = "<?php echo $customer_array[$key]["Lname"];?>" readonly>
									</div>
								</div>
								
								<div>
									<!-- Email -->
									<label for="checkout_email">Email Address</label>
									<input type="phone" id="checkout_email" class="checkout_input" required="required" value = "<?php echo $customer_array[$key]["Email"];?>" readonly>
								</div>
								
								<div>
									<label for="checkout_address">Address</label>
									<input type="text" id="checkout_address" class="checkout_input" required="required" value= "<?php echo $customer_array[$key]["Address"];?>" readonly>
									
								</div>
								
								

								<div>
								
									<label for="checkout_phone">Phone no</label>
									<input type="phone" id="checkout_phone" class="checkout_input" required="required" value= "<?php echo $customer_array[$key]["Contact"];?>" readonly >
								</div>
								


							</form>
									<div >
									
									<label for="checkout_zipcode">OrderNO</label>
									<input type="text" id="checkout_zipcode" class="checkout_input" required="required" value = "<?php  echo $order_Id;  ?>" readonly>
									</div>
								
									
						</div>
					</div>
				</div>

			

			</div>
		</div>
	</div>

</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/checkout.js"></script>
</body>
</html>