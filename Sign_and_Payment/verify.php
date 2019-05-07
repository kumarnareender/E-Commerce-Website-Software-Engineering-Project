<?php 
include_once("Database/connection.php");
 ?>

<?php 
    
    if (isset($_GET['Email']) && isset($_GET['Token']) ){
        $email= $_GET['Email'];
        $token= $_GET['Token'];
       
        $sql="SELECT CID  From customer WHERE Email='$email' AND Token='$token' AND ConfrimEmail='Not_Confrim'";
        $result=mysqli_query($conn,$sql);
          if ($result){
            $sql1="UPDATE customer SET Token='' , ConfrimEmail='Confrim' WHERE Email='$email'";
            $result1=mysqli_query($conn,$sql1);
             if ($result1) {
              header('Location:http://localhost/project/Sign_and_Payment/Sign.php');
              } 
        }
    else {
          echo "query not excuted";
          exit();
        }
      }




 ?>
