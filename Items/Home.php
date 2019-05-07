<?php
$j=0;
include('Database/connection.php');
?>
<?php
session_start();

//add to cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {

      $sql1 = "SELECT * FROM products WHERE product_id ='" . $_GET["product_id"] . "'";
      $sql2 = mysqli_query($conn, $sql1) or die("error getting");
      if(mysqli_num_rows($sql2) > 0){
      while ($row = mysqli_fetch_assoc($sql2)) {
          $productByCode[]=$row;  # code...
        }
      $itemArray = array($productByCode[0]["product_id"]=>array('product_title'=>$productByCode[0]["product_title"], 'product_id'=>$productByCode[0]["product_id"], 'quantity'=>strip_tags($_POST["quantity"]), 'product_price'=>$productByCode[0]["product_price"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["product_id"],$_SESSION["cart_item"])) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["product_id"] == $k)
                $_SESSION["cart_item"][$k]["quantity"] = strip_tags($_POST["quantity"]);
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
}
}

}



//fetching record
$sqlget = "SELECT * FROM products ORDER BY product_title ASC";
$sqldata = mysqli_query($conn, $sqlget) or die("error getting");
if(mysqli_num_rows($sqldata) > 0){
while ($row = mysqli_fetch_assoc($sqldata)) {
    $product_array[]=$row;  # code...
  }}
else{
  echo "failed";
  exit();
}

//add to cart

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
          
        <!---title -->      
          <title>Welcome To Online Shopping Store</title>
    </head>
    <body >
              <nav class="navbar navbar-expand-md navbar-light bg-light  fixed-top" style="box-shadow: 0 4px 2px -2px rgba(0,0,0,.3)">


                    <div class="d-flex w-30 order-0">
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
                                  <a class="nav-link active font-weight-bold newfont " style="font-size: 20px;" href="Home.php">Home</a>
                              </li>
                              <li class="nav-item active ">
                                  <a class="nav-link  font-weight-bold  newfont" style="font-size: 20px;" href="#products">Product</a>
                              </li>
                              <li class="nav-item active ">
                                  <a class="nav-link  font-weight-bold  newfont" style="font-size: 20px;"
                                   href="customer\complaint.php">Complaint</a>
                              </li>
                              <li class="nav-item active ">
                                  <a class="nav-link  font-weight-bold  newfont" style="fon-size: 20px" href="recomendation.php">Recommend</a>
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

 <div class="mt-5" >
              <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
              <ol class="carousel-indicators ">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="w-100 h-100 " src="img/Img2.jpg" alt="First slide">
              </div>
              <div class="carousel-item ">
                <img class="w-100 h-100   " src="img/Img1.jpg" alt="second slide">
              </div>
              <div class="carousel-item">
                <img class="w-100 h-100  " src="img/Img3.jpg" alt="Third slide">
              </div>
               <div class="carousel-item">
                <img class="w-100 h-100  " src="img/Img4.jpg" alt="fourth slide">
              </div>
             </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
            </div>
          </div>




              <div class="container">
                <h1 class="newfont font-weight-bold"  id="products" style="font-size: 50px;">Welcome To Online Shopping Store</h1>
      <h2 class="newh2 mt-5" >New Arrivals</h2>
        <div class="row">
                <?php
                if (!empty($product_array)) { 
                  foreach($product_array as $key=>$value){
                ?>  
          <div class="col-md-3 ">
          <div class="product-item">
<form method="post" action="Home.php?action=add&product_id=<?php echo $product_array[$key]["product_id"];?>">
            <img class="itemimage" style="border: 3px solid red; width:150px height:150px";  src="<?php echo $product_array[$key]['product_image'] ?>">           
        <div class="product-bottom  "  >
            <h3 class="font-weight-bold  mt-2"> <?php echo $product_array[$key]['product_title']; ?>
            <p><strong> <?php  echo "$".$product_array[$key]['product_price']; ?></strong></p></h3>
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
                 }
                }
              
                ?>
        </div>  
        </div>  






        </body>
        </html>
  