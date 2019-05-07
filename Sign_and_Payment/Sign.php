<?php 
include_once("Database/connection.php");
 ?>

<?php 
session_start();


$msg="";
$row = array();
$EMAIL="";
$PASS="";
      if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn,strip_tags($_POST['email']));
        $pswd  = mysqli_real_escape_string($conn,strip_tags($_POST['pswd']));
        $pswd = md5($pswd);
$result =$conn->query("SELECT Email,Password,ConfrimEmail From customer WHERE Email='$email' ");
         if(mysqli_num_rows($result) == 1 ){
            while ($row = $result->fetch_assoc()) {
             $CheckEmail=$row["ConfrimEmail"];
             $EMAIL=$row["Email"];
             $PASS=$row["Password"];
        if ($CheckEmail=="Confrim") {
            if($email==$EMAIL AND $pswd==$PASS){
               $msg="account login ";
                $_SESSION['username'] = $email;
                if($email == 'admin@admin.com'){
                    header('Location: http://localhost/project/items/adminportal/');
                }else{
                    header('Location: http://localhost/project/items/Home.php');
                }
          }else{
             $msg="Email And Password Invaid!! try again";
            }}        
        else{//please confrim email
         $msg="Please Verify Your Email?<br> Than Procced to Login";}
        }}else{
            $msg="User Not Exist!! try again";
           
          }  
        }



 ?>


<!DOCTYPE html>
<html>
<head>
	      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      

                 
      <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <!-- jQuery library -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- Popper JS -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <!-- Latest compiled JavaScript -->
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
          <link href='https://fonts.googleapis.com/css?family=Akronim' rel='stylesheet'>
       <!-- font awesome libaray-->  
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" type="text/css" href="css/Signin.css">
          <!---css -->
         
  <title>Sign In</title>
   
</head>

<body>

          
           <nav class="navbar navbar-expand-sm ">
          <a class="navbar-brand" href="#">
            <img src="img/logo.png" alt="SuperMarket" width="350px" height="90px"> </a>           
        </nav>

        <div class="row mt-4" style="justify-content: center;">
       <?php echo '<p class="font-weight-bold" style="color: red; 
       background:black ">'.$msg.'</p>'; ?> 
</div>
      
      <form action="Sign.php" method="post">
      <div class="login-box">
      <h1 class="font-weight-bold mt-5" style="color: black;">Login Here</h1>
      <div class="textbox">
      <i class="fa fa-user" aria-hidden="true"></i>
      <input type="email" placeholder="Email" name="email" value="" required>
      </div>
      <div class="textbox">
      <i class="fa fa-lock" aria-hidden="true"></i>
      <input  type="password" placeholder="Password" name="pswd" value="" required>
      </div>
      <input class="btn font-weight-bold" type="submit" name="submit" value="Sign In">
      <div class="btn-a font-weight-bold" style="color: red; 
      border: 6px solid blue; border-radius: 10px; background:black">
      <a  href="Register.php" style="margin-left: 80px" >For New Account</a>
      
      </div>
      </div>
      </form>

  

  
	      
</body>
</html>