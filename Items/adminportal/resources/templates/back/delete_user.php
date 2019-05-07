<?php require_once("../../config.php");


if(isset($_GET['id'])) {

$email = mysqli_query($connection,"SELECT email from users WHERE user_id = " . escape_string($_GET['id']) . " ");
if(mysqli_num_rows($email) != 0){
    while($row = $email->fetch_assoc() ){
        $customer = mysqli_query($connection,"DELETE FROM customer where email ='".$row['email'] . "'");
        confirm($customer);
    }
}
$query = query("DELETE FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
confirm($query);


set_message("User Deleted");
redirect("../../../index.php?users");


} else {

redirect("../../../index.php?users");


}






 ?>