<?php require_once("../../config.php");


if(isset($_GET['id'])) {


$query = query("DELETE FROM reports WHERE report_id = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("Report Deleted");
redirect("../../../index.php?reports");


} else {

redirect("../../../index.php?reports");


}






 ?>