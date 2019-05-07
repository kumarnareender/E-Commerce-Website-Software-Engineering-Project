<?php include("../../config.php");


if(isset($_GET['id'])) {


$query = query("DELETE FROM categories WHERE cat_id = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("Category Deleted");
redirect("../../../index.php?categories");


} else {

redirect("../../../index.php?categories");


}






 ?>