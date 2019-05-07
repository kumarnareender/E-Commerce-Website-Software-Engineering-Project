<?php
session_start();
include('Database/connection.php');

if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "remove":
			if (isset($_SESSION["cart_item"])) {
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k => $v) {
					
						if($_GET["product_id"] == $v["product_id"])
							unset($_SESSION["cart_item"][$k]);				
						if(empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);

				}
				
			}
		}
		break;
		case "empty":
			unset($_SESSION["cart_item"]);
		break;	
		case "edit":
			$total_price = 0;
			foreach ($_SESSION['cart_item'] as $k => $v) {
				
			if(strip_tags($_POST["code"]) == $v["product_id"]) {
			  	if(strip_tags($_POST["quantity"]) == '0') {
					  unset($_SESSION["cart_item"][$k]);
				} else {
					$_SESSION['cart_item'][$k]["quantity"] = strip_tags($_POST["quantity"]);
				  }
			  }
			 
	$total_price += $_SESSION['cart_item'][$k]["product_price"] * $_SESSION['cart_item'][$k]["quantity"];		//print_r($_SESSION['cart_item']);
				  
			}
			if($total_price!=0 && is_numeric($total_price)) {
				print "$" . number_format($total_price,2);
				exit;
			}
			
		break;		
	}
}

$session_items = 0;
if(!empty($_SESSION["cart_item"])){
  $session_items = count($_SESSION["cart_item"]);

} 

?>
<html>
    <head>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                 
      <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <!-- jQuery library -->
          <script src="jQuery.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- Popper JS -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript and datepicker -->
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
               <!-- font awesome libaray-->  
               <link href='https://fonts.googleapis.com/css?family=Akronim' rel='stylesheet'>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!---css -->
          <link rel="stylesheet" href="css/itemstyle.css">
        <link href="css/style.css" type="text/css" rel="stylesheet" />

          
        <!---title -->      
          <title>Shopping Cart</title>
    </head>
    <body >

<nav class="navbar navbar-expand-md navbar-light bg-light  fixed-top" style="box-shadow: 0 4px 2px -2px rgba(0,0,0,.3)">


	<div class="d-flex w-40 order-0">
		<div class="w-40">
					<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav">
					<span class="navbar-toggler-icon"></span>
					</button>
		</div>          

		<a class="navbar-brand  " href="home.php">
		<img  src="img/selogo.jpg"  width="90" height="50"  alt="" /><i class="NewFontTitle ml-2 ">Online Shopping Store</i></a>
		<span class="w-40"></span>
				
	</div>

 
	<div class="collapse navbar-collapse w-40 order-1 order-lg-0 text-center " id="navbarNav">
		<ul class="navbar-nav">
					<li class="nav-item active  ">
							<a class="nav-link active font-weight-bold newfont " style="font-size: 30px;" href="Home.php">Home</a>
					</li>
					<li class="nav-item active ">
							<a class="nav-link  font-weight-bold  newfont" style="font-size: 30px;" href="#products">Product</a>
					</li>
					
		</ul>
		<ul>
			 <form action="results.php" method="post">
				<div class="input-group">
						<input type="text"  id="search" class="form-control" style="padding: 18px; margin-top: 16px; font-size: 15px;" placeholder="Search" name="search">
						<div class="input-group-btn">
								<button class="btn btn-default" style="background: orange; margin-top: 15px; width: 60px; padding: 6.5px;" type="submit">
								<i class="fa fa-search" style="font-size: 15px; "></i></button>
						</div>
				</div>
			 </form>
			 
	    </ul>
	<ul class="nav navbar-right"   >
		<ol class="mr-5" >
		 
			<button class="btn btn-outline-primary btn-style font-weight-bold" 
				onclick="window.location.href='shopping_cart.php'">
				Cart (<?php echo $session_items;?>)<i class="fa fa-shopping-cart"></i></button> 


		 
		</ol>
	</ul>
	
			
			

		<ul class="nav navbar-right top-nav">
			<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
					<?php 
					if(isset($_SESSION['username']) ){
					echo $_SESSION['username'];
					} else {
					echo "unregistered user";        }
					?>
					<b class="caret"></b></a>
					<ul class="dropdown-menu">           
					<li class="divider"></li>
					<li>
					<a href="http://localhost/project/Sign_and_Payment/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>  
</nav>


<div class="container">
	<div class="row">


		<div id="shopping-cart"  class="align-center">
			<div class="txt-heading row">Shopping Cart </div>
			<form name="frmCartEdit" id="frmCartEdit">
				<?php
					$total_price = 0.00;
					if(isset($_SESSION["cart_item"])){
				?>
				<?php 
					foreach ($_SESSION["cart_item"] as $item) { 
						$sql3=("SELECT * FROM products WHERE product_id = '" . $item["product_id"] . "'");
						$sql2 = mysqli_query($conn, $sql3) or die("error getting");
								if(mysqli_num_rows($sql2) > 0){
								while ($row = mysqli_fetch_assoc($sql2)) {
										$product_info[]=$row;
								}
							$total_price += $item["product_price"] * $item["quantity"];	
				?>
				<div class="product-item" onMouseOver="document.getElementById('remove<?php echo $item["product_id"];?>').style.display='block';"  onMouseOut="document.getElementById('remove<?php echo $item["product_id"]; ?>').style.display='';">

					<div class="product-image"><img width="100px" height="100px" src="<?php echo $product_info[0]["product_image"]; ?>"></div>
					<div><strong><?php echo $item["product_title"]; ?></strong></div>
					<div class="product-price"><?php echo "$".$item["product_price"]; ?></div>
					<div>Quantity: <input type="text" name="quantity" id="<?php echo $item["product_id"]; ?>" value="<?php echo $item["quantity"]; ?>" size="2" onBlur="saveCart(this);" /></div>
					<div class="btnRemoveAction" id="remove<?php echo $item["product_id"]; ?>">
						<a href="shopping_cart.php?action=remove&product_id=<?php echo $item["product_id"];?>" title="Remove from Cart">X</a>
					</div>
				</div>
					<?php
							}
							}
							}
					?>
			</form>
			<div class="cart_footer_link">
				<div class="pull-center">Total Price: <h2 id="total_price" style="color: #FFF;"><?php echo "$". number_format($total_price,2); ?></h2>
				</div>
					<a href="shopping_cart.php?action=empty" class="btn btn-lg btn-warning">Clear Cart</a>
					<a href="Home.php" title="Cart" class="btn btn-lg btn-primary">Continue Shopping</a>
					<a href="checkout.php" title="Checkout" class="btn btn-lg btn-success">Checkout</a>
			</div>
		</div>




	</div>

</div>

<!--payment-->





<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>
function saveCart(obj) {
	var quantity = $(obj).val();
	var code = $(obj).attr("id");

	$.ajax({
		url: "?action=edit",
		type: "POST",
		data: 'code='+code+'&quantity='+quantity,
		success: function(data, status){$("#total_price").html(data)},
		error: function () {alert("Problem in sending reply!")}
	});
}
</script>
</body>
</HTML>