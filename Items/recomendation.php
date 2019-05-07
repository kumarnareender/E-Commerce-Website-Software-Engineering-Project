<?php
include('Database/connection.php');
?>
<?php

//fetching record
$records = array();
 $pid=array();
$i =0;
$sql = mysqli_query($conn,"SELECT product_id from rate order by rate asc") or die("error getting");
?>
<!DOCTYPE html>
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


         
    </head>

    <body >

              
              <nav class="navbar navbar-expand-md navbar-light bg-light  fixed-top" style="box-shadow: 0 4px 2px -2px rgba(0,0,0,.3)">


                    <div class="d-flex w-30 order-0">
                  <div class="w-40">
                          <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav">
                          <span class="navbar-toggler-icon"></span>
                          </button>
                  </div>          

                  <a class="navbar-brand  ">
                  <img  src="img/selogo.jpg"  width="90" height="50"  alt="" /><i class="NewFontTitle ml-2 ">Online Shopping Store</i></a>
                  <span class="w-40"></span>
                          
                      </div>

                     
                      <div class="collapse navbar-collapse w-40 order-1 order-lg-0 text-center " id="navbarNav">
                          <ul class="navbar-nav">
                              <li class="nav-item active  ">
                                  <a class="nav-link active font-weight-bold newfont " style="font-size: 20px;" href="Home.php">Home</a>
                              </li>
                              <li class="nav-item active ">
                                  <a class="nav-link  font-weight-bold  newfont" style="font-size: 20px;" href="#products">Product</a>
                              </li>
                              <li class="nav-item font-weight-bold active  newfont" style="font-size: 20px;"> 
                                <a class="nav-link " href="#">Contact</a>
                              </li>

                              <li class="nav-item active ">
                                  <a class="nav-link  font-weight-bold  newfont" style="font-size: 20px;"
                                   href="adminportal\resources\templates\back\complaint.php">Complaint</a>
                              </li>
                              </li>

                              <li class="nav-item font-weight-bold active  newfont" style="font-size: 20px;"> 
                                <a class="nav-link " href="adminportal\resources\templates\back\viewcart.php">Cart</a>
                              </li>

                          </ul>
                          <ul>
                           <form action="#" method="post">
                            <div class="input-group">
                              <input type="text" class="form-control" style="padding: 10px; margin-top: 15px; font-size: 15px;" placeholder="Search" name="search">
                              <div class="input-group-btn">
                                <button class="btn btn-default" style="background: orange; margin-top: 15px; width: 30px; padding: 6.5px;" type="submit">
                              <i class="fa fa-search" style="font-size: 15px; "></i></button></div></div>
                           </form>
                           
                      </ul>

                          <a class="btn btn-outline-primary ml-5 mr-4 btn-sytle font-weight-bold " 
                          href="http://localhost/project/Sign_and_Payment/Sign.php" data-toggle="modal" data-target="#modalLoginForm" >Pay Here
                          </a>

                          <ul class="nav navbar-right top-nav">
  <li class="dropdown">
  <?php if(isset($_SESSION['username'])){?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
    <?php echo $_SESSION['username'];?>

    <b class="caret"></b></a>
        <ul class="dropdown-menu">
           
            <li class="divider"></li>
            <li>
                <a href="http://localhost/project/Sign_and_Payment/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>

  <?php }else{ ?>
    <a href="http://localhost/project/Sign_and_Payment/Sign.php" class="btn btn-outline-primary ml-5 btn-sytle font-weight-bold " role="button">Sign in <i class="fa fa-lock"></i></a>
 <?php }?>
    </li>
</ul>

                      </div>  
                    </nav>

              
              <div class="container">
                <h1 class="newfont font-weight-bold"  id="products" style="font-size: 50px;">Recommendation</h1>
               
                <div class="row">

<?php 
$i = 0;
    while($ro = mysqli_fetch_assoc($sql) and $i < 10){
      $pid = $ro['product_id'];
      $sqlget = "SELECT * FROM products where product_id = $pid ";
      $sqldata = mysqli_query($conn, $sqlget) or die("error getting");
      if(mysqli_num_rows($sqldata) > 0){
        while($row = mysqli_fetch_assoc($sqldata)){?>

<div class="col-md-3 ">
  <div class="product-item">
<form method="post" action="Home.php?action=add&product_id=<?php echo $row["product_id"];?>">
    <img class="itemimage" style="border: 3px solid red; width:150px height:150px";  src="<?php echo $row['product_image']; ?>">           
<div class="product-bottom  "  >
    <h3 class="font-weight-bold  mt-2"> <?php echo $row['product_title']; ?>
    <p><strong> <?php  echo "$".$row['product_price']; ?></strong></p></h3>
    <input name="quantity" style="width:80px;" list="productss" autocomplete="off">
    <datalist id="productss">
    <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </datalist>
      <input type="submit" value="Add to cart" class="btn btn-primary btnAddAction" />

      
</div>
    </form>
</div>
</div>


       <?php }
      }else{
        echo "failed";
      }
      $i++;
    }
    ?>
                </div>  
                </div>  
        </body>
        </html>

