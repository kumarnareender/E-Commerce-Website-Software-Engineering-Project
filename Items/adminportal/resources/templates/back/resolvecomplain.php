<?php include("../../config.php");


if(isset($_GET['id'])) {


$query = query("DELETE FROM complaint WHERE complaintid = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("Complaint Resolve");
redirect("../../../index.php?complaint");


} else {

redirect("../../../index.php?complaint");


}
 ?>