<?php 
include_once("Database/connection.php");
 ?>


<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

  $msg="";

    if (isset($_POST['submit'])) {
      $fname   = strip_tags(mysqli_real_escape_string($conn,$_POST['Fname']));
      $lname   = strip_tags(mysqli_real_escape_string($conn,$_POST['Lname']));
      $email   = strip_tags(mysqli_real_escape_string($conn,$_POST['Email']));
      $pswd    = strip_tags(mysqli_real_escape_string($conn,$_POST['Password']));
      $cpswd    = strip_tags(mysqli_real_escape_string($conn,$_POST['CPassword']));
      $adr     = strip_tags(mysqli_real_escape_string($conn,$_POST['Address']));
      $city    = strip_tags(mysqli_real_escape_string($conn,$_POST['City']));
      $contact = strip_tags(mysqli_real_escape_string($conn,$_POST['Contact']));
      $country = strip_tags(mysqli_real_escape_string($conn,$_POST['Country']));
      $username = $fname . '_'. $lname;
    
              //Check Existing User
      $sql = $conn->query("SELECT cid  From customer WHERE email='$email'");
          if ($sql->num_rows > 0) {
             $msg = "User Already Exist "; }
          elseif ($pswd!=$cpswd) {
            $msg = "Password not Match try again!!"; 
          }
          else{
           //Generate key and encrypt password
           $token = md5(time().$adr);
           $pswd  = md5($pswd);
           $check_username_query = mysqli_query($conn, "SELECT username FROM users where username='$username'");
           $i = 0;
           while (mysqli_num_rows($check_username_query) != 0 ){
               $i++;
               $username = $username. '_'. $i;
               $check_username_query = mysqli_query($conn, "SELECT username FROM users where username='$username'");
           }

    $sql =("INSERT INTO customer(Fname,Lname,Email,Password,Address,Contact,City,Country,
                                                   ConfrimEmail,Token)
              Values('$fname','$lname','$email','$pswd','$adr','$contact','$city','$country','Not_Confrim','$token')");
    $in_users = mysqli_query($conn, "INSERT INTO users(user_id,username,email,password) values('','$username','$email','$pswd')");
          
           if (mysqli_query($conn, $sql)) { 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

                  // Instantiation and passing `true` enables exceptions
                  $mail = new PHPMailer();

                  try {
                          //Server settings
                          //$mail->SMTPDebug = 4;                                       // Enable verbose debug output
                          $mail->isSMTP();                                            // Set mailer to use SMTP
                          $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                          $mail->Username   = 'seprojectmail2019@gmail.com';                     // SMTP username
                          $mail->Password   = 'seproject2019';                               // SMTP password
                          $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
                          $mail->Port       = 465;                                    // TCP port to connect to

                          //Recipients
                          $mail->setFrom('seprojectmail2019@gmail.com','Shopping mall');
                          $mail->addAddress($email, $fname);     // Add a recipient
                         
                          // Content
                          $mail->isHTML(true);                                  // Set email format to HTML
                          $mail->Subject = 'Please Verify Email';
                          $mail->Body    = 'Click below link to verify your email!<br><br>
  <a href="http://localhost/project/Sign_and_Payment/verify.php?Email='.$email.'&Token='.$token.'">Click Here</a>';
                          $mail->send();
                          $msg= 'Check you email!!';
                      } catch (Exception $e) {
                         }
                  
               
            }else {
              echo "Error: " . $sql . "" . mysqli_error($conn);
            }



          }

    }


  ?>



<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                 
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <!---css -->
          <link rel="stylesheet" href="css/datepicker.css">
          <link rel="stylesheet" type="text/css" href="css/global.css">
          
          
          
        <!---title -->      
          <title>Register Here </title>
    </head>
        
    <body class="bg ">
         <nav class="navbar navbar-expand-sm fixed-top ">
          <a class="navbar-brand" href="#">
            <img src="img/logo.png" alt="SuperMarket" width="350px" height="90px"> </a>           
        </nav>
  

    <div class="container" >
   <div class="row ">
    <div class="col-md-6 col-sm-6 col-xs-12  mt-sm-3 mt-md-3 mt-xl-3 text-center" style="top: 20vh;">
        <h1 class="mt-5">Welcome Here You can Register our Online Shopping Center Enjoy It..</h1>
    
  </div>
        <div class="col-md-6 col-sm-12 col-xs-12 ">
          <div class="text-center form-container " style="top: 20vh;"  >
                <div class="col-md-12 col-sm-6  " >
                   <h1 class="text-white">Register Here</h1>
                   <?php echo '<p class="font-weight-bold" style="color: white; text-align: center">'.$msg.'</p>'; ?>
                <form action="Register.php" method="post" autocomplete="on">
                    <div class="row justify-content-center">
                      <input class="form-group mr-2" type="text"  required="" name="Fname" placeholder="First Name">
                      <input class="form-group mr-2" type="text"  required="" name="Lname" placeholder="Last Name">
                      <input class="form-group mr-2" type="Email" required=""  name="Email" placeholder="Email">
                      <input class="form-group mr-2" type="Password" required=""  name="Password" placeholder="Password">
                      <input class="form-group mr-2" type="Password" required="" name="CPassword" placeholder="Confrim Password">
                      <input class="form-group mr-2" type="text" required=""  name="Address" placeholder="Address">
                      <input class="form-group mr-2" type="text" required="" name="Contact" placeholder="Contant No">
                      <input class="form-group mr-2" type="text" required="" name="City" placeholder="City">
                      <input class="form-group mr-2" type="text" required="" name="Country" placeholder="Country">
                    </div>

                    <div>
                      <input class="btn font-weight-bold  btn-outline-primary" type="submit" name="submit" value="Register">
                    </div>
                    <div >
                      <a href="Sign.php" class="m-4 font-weight-bold" >Already Account</a>
                      
                    </div>
                        

            </form>
                  </div>
                  </div>
                  </div>
                  </div>  
                  </div>
 
  


        

           <script src="js/scripts.min.js"></script>
            <script src="js/main.min.js"></script> 




    </body>
    </html> 