<?php
include("config.php");
$email = ' ';
$cusemail = ' ';
$totalamount = 0;
$cproduct_quantity = 0;

	$product_id = $_GET['id'];
	$email = $_SESSION['email'];

	$query = query("SELECT * FROM products where product_id = '$product_id'");
    confirm($query);

    while($row = fetch_array($query)) {
    $price = escape_string($row['product_price']);
    $product_quantity = escape_string($row['product_quantity']);
}

    $cart_query = query("SELECT * from cart where cusemail = '$email' and productid ='$product_id'");
    confirm($cart_query);
    while($row = fetch_array($cart_query)){
        $cusemail = escape_string($row['cusemail']);
    }
    
    if($cusemail == $email){
    	if($product_quantity > 0){
    		$p_qntty = $product_quantity-1;
    $cart_query = "SELECT * from cart where cusemail = '$email' and productid ='$product_id'";
    confirm($cart_query);
    while($row = fetch_array($cart_query)){
        $totalamount = escape_string($row['totalamount']);
        $cproduct_quantity = escape_string($row['product_quantity']);
    }

    $amount = $totalamount+$price;
    $qntty = $cproduct_quantity+1;

    $query = query("UPDATE cart SET product_quantity ='$qntty', totalamount = '$amount' 
    		WHERE email='$email' and productid = '$product_id'");
    		confirm($query);
    		echo "Adding to cart";

    $query = query("UPDATE products SET product_quantity='$p_qntty' WHERE product_id = '$product_id'");
    confirm($query);
    }
    else{
    	echo "Sorry product is not available in the stock";
    }
    }


    else{

        if($product_quantity > 0){

    	$qntty = 1;
    	$query = query("INSERT INTO cart(cusemail,productid,product_quantity,totalamount) 
    				values('$email','$product_id','$qntty','$price')");
            confirm($query);
            

            $qntty = $product_quantity-1;
            $query = query("UPDATE products SET product_quantity='$qntty' WHERE product_id = '$product_id'");
            confirm($query);

            echo "Adding to cart successfully";
    	}
        else{
        echo "Sorry product is not available in the stock";
    }

    }
 ?>