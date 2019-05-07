<?php include("../../config.php");


if(isset($_GET['id'])) {

$query = query("DELETE FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("Product Deleted");
redirect("../../../index.php?products");
} else {
redirect("../../../index.php?products");
}

 ?>