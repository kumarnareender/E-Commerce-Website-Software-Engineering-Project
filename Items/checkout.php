<?php 
include_once("Database/connection.php");
session_start();

//payment
if (isset($_POST['pay'])) {
	$cardnumber   = strip_tags(mysqli_real_escape_string($conn,$_POST['cardNumber']));
	$payment   = strip_tags(mysqli_real_escape_string($conn,$_POST['payment']));

	if (isset($_SESSION['username'])){
		$email=$_SESSION['username'];
			$sql =("INSERT INTO payment(pay_id,CardNumber,Payment,Email) Values ('','$cardnumber','$payment',
				'$email')");
			if (mysqli_query($conn, $sql)) { 
				//clear cart and other details
				if (isset($_SESSION["cart_item"])) {
					if(!empty($_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k) {
						$prodi = $k['product_id'];
						$quant = $k['quantity'];
						$title = $k['product_title'];
						$price = $k['product_price'];
						$sq = ("INSERT INTO cart(id,product_id, quantity,product_title,product_price) values('',$prodi,$quant,'$title',$price)");
						mysqli_query($conn,$sq);
						$orderi = mysqli_query($conn,"select order_id from orders order by order_id desc limit 1 ");
						$ro = mysqli_fetch_assoc($orderi);
						$orderi = $ro['order_id'];
						$sqt = ("INSERT INTO reports(report_id,product_id,order_id,product_price,product_title,product_quantity) values('',$prodi,$orderi,$price,'$title',$quant)");	
						mysqli_query($conn,$sqt);
				
					}
				}
			}
			unset($_SESSION["cart_item"]);
			mysqli_query($conn,'TRUNCATE table cart');
				
			}
	}
	
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkout</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://unpkg.com/basscss@8.0.2/css/basscss.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/checkout.css">
<link rel="stylesheet" type="text/css" href="css/checkout_responsive.css">
</head>
<body>

<div class="super_container">
	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url(img/defaults/cart.jpg)"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="breadcrumbs">
									<ul style="color: black">
										<li><a href="Home.php">Home</a></li>
										<li><a href="shopping_cart.php">Shopping Cart</a></li>
										<li><a href="checkout.php">Checkout</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Checkout -->
	<?php 
		if (isset($_SESSION['username'])){
			$email=$_SESSION['username'];

			$sql  = ("SELECT * FROM customer WHERE Email='$email'");
			$sqldata = mysqli_query($conn, $sql) or die("error getting");
			if ($sqldata) {
			if(mysqli_num_rows($sqldata) > 0){
			while ($row = mysqli_fetch_assoc($sqldata)) {
			    $customer_array[]=$row; 
			  }
			}
			}
			}else{
				header("Location: http://localhost/project/Sign_and_Payment/Sign.php");
			}
	 ?>
	
	<div class="checkout">
		<div class="container">
			<div class="row">

				<!-- Billing Info -->
				<div class="col-lg-6">
					<div class="billing checkout_section">
						<div class="section_title">Billing Address</div>
						<div class="section_subtitle">Enter your address info</div>
						<div class="checkout_form_container">
							
							<form action="display.php" method="post" id="checkout_form" class="checkout_form">
								<div class="row">
									<div class="col-xl-6">
										<!-- Name -->
										<?php 
										if (!empty($customer_array)) { 
											foreach ($customer_array as $key=>$value) {
											
										} ?>
									<label for="checkout_name">First Name*</label>
							<input type="text" id="checkout_name" class="checkout_input" required="required" value ="<?php echo $customer_array[$key]["Fname"];?>" name="fname" >
									</div>
									<div class="col-xl-6 last_name_col">
										<!-- Last Name -->
									<label for="checkout_last_name">Last Name*</label>
							<input type="text" id="checkout_last_name" class="checkout_input" required="required" value = "<?php echo $customer_array[$key]["Lname"]; ?>" name="lname">
									</div>
								</div>

								<div>
									<!-- Email -->
									<label for="checkout_email">Email Address*</label>
						<input type="phone" id="checkout_email" name="mail" class="checkout_input" required="required" value = "<?php echo $customer_array[$key]["Email"];?>"> 
								
								</div>
							

								<div class="row">
									<div class="col-xl-6">
										<label for="checkout_city">City*</label >
									<input type="text" class="checkout_input" name="checkout_city" id="checkout_city"
									value="<?php echo $customer_array[$key]["City"]; ?>"> 
										
									</div>

									<div class="col-xl-6">
									<label for="checkout_country">Country*</label>
									<input class="checkout_input"type="text" name="checkout_country" 
									value="<?php echo $customer_array[$key]["Country"]; ?>">
								</div>
									
								</div>

								<div>
									<!-- Address -->
									<label for="checkout_address">Address*</label>
									<input type="text" id="checkout_address" class="checkout_input" required="required" name="addr1"
									value="<?php  echo $customer_array[$key]["Address"]; ?>">
									
								</div>

								
								<div>
									<!-- Phone no -->
									<label for="checkout_phone">Phone no*</label>
									<input type="phone" id="checkout_phone" class="checkout_input" required="required" name = "telephone"
									 value="<?php  echo $customer_array[$key]["Contact"]; ?>" >
								</div>
								
								<div class="checkout_extra">
									<div>
										<input type="checkbox" id="checkbox_terms" name="regular_checkbox" class="regular_checkbox" checked="checked">
										<label for="checkbox_terms"><img src="img/defaults/check.png" alt=""></label>
										

									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Order Info -->

				<div class="col-lg-6">
					<div class="order checkout_section">
						<div class="section_title">Your order</div>
						<div class="section_subtitle">Order details</div>

						<!-- Order details -->
						<div class="order_list_container">
							<div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
						<div class="order_list_title font-weight-bold">Product</div>
						<div class="order_list_title font-weight-bold" style="margin-left: 350px ">Price</div>
							</div>
							</div>

							<ul class="order_list">
								<?php 
							}
								$total=0;
							if (isset($_SESSION["cart_item"])) {
								if(!empty($_SESSION["cart_item"])) {
								foreach($_SESSION["cart_item"] as $k) {
						echo '<li class="d-flex flex-row align-items-center justify-content-start">
							<div class="order_list_title">'.$k['product_title'].'</div>
							<div class="order_list_value ml-auto">'. $k['product_price']. '</div> </li>';
								$total=$total+$k['product_price'] * $k['quantity'];
							}

						if(!empty($_SESSION["cart_item"])){
						echo '<li class="d-flex flex-row align-items-center justify-content-start">
						<div class="order_list_title font-weight-bold">Total Amount</div>
							<div style="margin-left: 350px " class="order_list_title font-weight-bold">'.$total.'</div>';
					
													}
												}
											}

								?>
							</ul>
						</div>				
						
						<div class="button order_button btn-primary actionShowModal">
							<a href="" data-toggle="modal" data-target="#myModal" >Place Order</a>
							
						</div>
						</div>

				</div>
			</div>
		</div>
	</div>

</div>


<form action="display.php#shop" method="POST" >
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
    		<div class="modal-header">
          	<h4 class="modal-title font-weight-bold">Payment</h4>
          	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	</div>
			
			  <div class="modal-body">
        	 <div class="row col-12">
         	<div class="col-xl-6">
         		<label class="font-weight-bold">Name :</label>
         		<h4><?php echo $customer_array[$key]["Fname"];?></h4>
         	</div>
         	<div class="col-xl-6">
         		<label class="font-weight-bold">Email</label>
         		<h4><?php echo $customer_array[$key]["Email"];?></h4>
         	</div>
         	</div>
        	 <div class="row col-12 mt-4">	
    	     	<div class="col-xl-6 ">
         		<label class="font-weight-bold">Phone No</label>
         		<h4><?php echo $customer_array[$key]["Contact"];?></h4>
         	</div>
	         <div class="row col-12 mt-4">	
	         	<div class="col-xl-6">
         		<label class="font-weight-bold">Card Number</label>
         		<input type="Text" name="cardNumber">
         	</div>
         	<div class="col-xl-6">
         		<label class="font-weight-bold">Total Amount</label>
         		<h4><?php echo "$".$total;?></h4>
						 <input type="hidden" name="payment" value="<?php echo $total; ?>">
         	</div>

				</div>
	         </div>
	     	</div>
	     

      	<div class="modal-footer">
        <input  type="submit" name="pay" value="Pay" class="btn btn-danger btn-lg" 
         >
        </div>
      </form>

      </div>
  </div>
</div>

</form>





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