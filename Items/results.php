<?php
include('adminportal/resources/config.php');

?>

<?php
$records = array();
$i =0;
$searchq = strip_tags($_POST['search']);
	$searchq = preg_replace("#[^0-9a-z]#i","", $searchq);

if(isset($_POST['search'])){
$sqlget = "SELECT * FROM products WHERE product_title LIKE '%$searchq%'";
$sqldata = mysqli_query($connection, $sqlget) or die("error getting");
$rows=mysqli_num_rows($sqldata);
if(mysqli_num_rows($sqldata) > 0)
{
while ($row = mysqli_fetch_assoc($sqldata)) {
    $records[]=$row;  # code...
}
}
else{
  echo "failed";
}
}


$session_items = 0;
if(!empty($_SESSION["cart_item"])){
  $session_items = count($_SESSION["cart_item"]);
}

?>


<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                 
      <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <!-- jQuery library -->
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

          
          <style>
            <style>
                          
  
          </style>
        <!---title -->      
          <title>Item Page</title>
    </head>

    <body >

    <nav class="navbar navbar-expand-md navbar-light bg-light  fixed-top" style="box-shadow: 0 4px 2px -2px rgba(0,0,0,.3)">


<div class="d-flex w-40 order-0">
<div class="w-40">
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
      </button>
</div>          

<a class="navbar-brand  " href="home.php">
<img  src="img/selogo.jpg"  width="90" height="50"  alt="" /><i class="NewFontTitle ml-2 ">Online Shopping Store</i></a>
<span class="w-40"></span>
      
  </div>

 
  <div class="collapse navbar-collapse w-40 order-1 order-lg-0 text-center " id="navbarNav">
    <ul class="navbar-nav">
          <li class="nav-item active  ">
              <a class="nav-link active font-weight-bold newfont " style="font-size: 30px;" href="Home.php">Home</a>
          </li>
          <li class="nav-item active ">
              <a class="nav-link  font-weight-bold  newfont" style="font-size: 30px;" href="#products">Product</a>
          </li>
          
    </ul>
    <ul>
       <form action="results.php" method="post">
        <div class="input-group">
          <input type="text"  id="search" class="form-control" style="padding: 18px; margin-top: 16px; font-size: 15px;" placeholder="Search" name="search">
          <div class="input-group-btn">
            <button class="btn btn-default" style="background: orange; margin-top: 15px; width: 60px; padding: 6.5px;" type="submit">
          <i class="fa fa-search" style="font-size: 15px; "></i></button></div></div>
       </form>
       
  </ul>
  <ul class="nav navbar-right"   >
    <ol class="mr-5" >
     
<button class="btn btn-outline-primary btn-style font-weight-bold" 
  onclick="window.location.href='shopping_cart.php'">
  Cart (<?php echo $session_items;?>)<i class="fa fa-shopping-cart"></i></button> 


     
    </ol>
  </ul>
  
      
      

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
                <h2 class="newh2">New Arrivals</h2>
                <div class="row">

                <?php
                  while(!empty($rows) and $i < $rows){
                ?>  
          <div class="col-md-3 ">
          <div class="product-item">
<form method="post" action="Home.php?action=add&product_id=<?php echo $records[$i]["product_id"];?>">
            <img class="itemimage" style="border: 3px solid red; width:150px height:150px";  src="<?php echo $records[$i]['product_image'] ?>">           
        <div class="product-bottom  "  >
            <h3 class="font-weight-bold  mt-2"> <?php echo $records[$i]['product_title']; ?>
            <p><strong> <?php  echo "$".$records[$i]['product_price']; ?></strong></p></h3>
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
                  <?php
                  $i++;
                 }
                ?>

                </div>  
                </div>  




        </body>
        </html>

