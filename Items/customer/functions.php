<?php 

$upload_directory = "uploads";
// helper functions
function set_message($msg){
if(!empty($msg)) {
    
$_SESSION['m'] = $msg;

} else {

$msg = "";


    }


}

function display_message() {
    // echo 'Set';
    if(isset($_SESSION['m'])) {
        
        echo $_SESSION['m'];
        unset($_SESSION['m']);

    }
}


function redirect($location){

return header("Location: $location ");


}





function query($sql) {

    $connection = mysqli_connect('localhost', 'root', '', 'shopping_database');

return mysqli_query($connection, $sql);


}


function confirm($result){

    $connection = mysqli_connect('localhost', 'root', '', 'shopping_database');

if(!$result) {

die("QUERY FAILED " . mysqli_error($connection));


	}


}


function escape_string($string){

    $connection = mysqli_connect('localhost', 'root', '', 'shopping_database');

return mysqli_real_escape_string($connection, $string);


}



function fetch_array($result){

return mysqli_fetch_array($result);


}


function last_id(){

global $connection;

return mysqli_insert_id($connection);


}




/****************************BACK END FUNCTIONS************************/


function display_orders(){



$query = query("SELECT * FROM orders");
confirm($query);


while($row = fetch_array($query)) {


$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a class="btn btn-danger" href="../adminportal/resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>




DELIMETER;

echo $orders;



    }



}




/************************ Admin Products Page ********************/

function display_image($picture) {

global $upload_directory;

// return $upload_directory  . DS . $picture;



}





function get_products_in_admin(){


$query = query(" SELECT * FROM products");
confirm($query);

while($row = fetch_array($query)) {

$category = show_product_category_title($row['product_category_id']);

$product_image = display_image($row['product_image']);

$product = <<<DELIMETER

        <tr>
            <td>{$row['product_id']}</td>

            <td>

             <a href="index.php?edit_product&id={$row['product_id']}"><p>{$row['product_title']}</p></a>

            <div>

            <img width='100' src={$row['product_image']}>

            </div>




            </td>


            <td>{$category}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-danger" href="../adminportal/resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $product;


        }





}


function show_product_category_title($product_category_id){


$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
confirm($category_query);

while($category_row = fetch_array($category_query)) {

return $category_row['cat_title'];

}



}






/***************************Add Products in admin********************/


function add_product() {


if(isset($_POST['publish'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);

move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);


$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', 'img/{$product_image}')");
$last_id = last_id();
confirm($query);
set_message("New Product with id {$last_id} was Added");
redirect("index.php?products");


        }


}

function show_categories_add_product_page(){


$query = query("SELECT * FROM categories");
confirm($query);

while($row = fetch_array($query)) {


$categories_options = <<<DELIMETER

 <option value="{$row['cat_id']}">{$row['cat_title']}</option>


DELIMETER;

echo $categories_options;

     }



}



/***************************updating product code ***********************/

function update_product() {


if(isset($_POST['update'])) {


$product_title          = escape_string($_POST['product_title']);
$product_category_id    = escape_string($_POST['product_category_id']);
$product_price          = escape_string($_POST['product_price']);
$product_description    = escape_string($_POST['product_description']);
$short_desc             = escape_string($_POST['short_desc']);
$product_quantity       = escape_string($_POST['product_quantity']);
$product_image          = escape_string($_FILES['file']['name']);
$image_temp_location    = escape_string($_FILES['file']['tmp_name']);


if(empty($product_image)) {

$get_pic = query("SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");
confirm($get_pic);

while($pic = fetch_array($get_pic)) {

$product_image = $pic['product_image'];

    }

}



move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);


$query = "UPDATE products SET ";
$query .= "product_title            = '{$product_title}'        , ";
$query .= "product_category_id      = '{$product_category_id}'  , ";
$query .= "product_price            = '{$product_price}'        , ";
$query .= "product_description      = '{$product_description}'  , ";
$query .= "short_desc               = '{$short_desc}'           , ";
$query .= "product_quantity         = '{$product_quantity}'     , ";
$query .= "product_image            = '{$product_image}'          ";
$query .= "WHERE product_id=" . escape_string($_GET['id']);





$send_update_query = query($query);
confirm($send_update_query);
set_message("Product has been updated");
redirect("index.php?products");


        }


}

/*************************Categories in admin ********************/


function show_categories_in_admin() {


$category_query = query("SELECT * FROM categories");
confirm($category_query);


while($row = fetch_array($category_query)) {

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];


$category = <<<DELIMETER


<tr>
    <td>{$cat_id}</td>
    <td>{$cat_title}</td>
    <td><a class="btn btn-danger" href="../adminportal/resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>



DELIMETER;

echo $category;



    }



}


function add_category() {

if(isset($_POST['add_category'])) {
$cat_title = escape_string($_POST['cat_title']);

if(empty($cat_title) || $cat_title == " ") {

echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";


} else {


$insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
confirm($insert_cat);
set_message("Category Created");



    }


    }




}

 /************************admin users***********************/



function display_users() {


$category_query = query("SELECT * FROM users");
confirm($category_query);


while($row = fetch_array($category_query)) {

$user_id = $row['user_id'];
$username = $row['username'];
$email = $row['email'];
$password = $row['password'];

$user = <<<DELIMETER


<tr>
    <td>{$user_id}</td>
    <td>{$username}</td>
     <td>{$email}</td>
    <td><a class="btn btn-danger" href="../adminportal/resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>



DELIMETER;

echo $user;



    }



}


function add_user() {


if(isset($_POST['add_user'])) {


$username   = escape_string($_POST['username']);
$email      = escape_string($_POST['email']);
$password   = escape_string($_POST['password']);
// $user_photo = escape_string($_FILES['file']['name']);
// $photo_temp = escape_string($_FILES['file']['tmp_name']);


// move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);


$query = query("INSERT INTO users(username,email,password) VALUES('{$username}','{$email}','{$password}')");
confirm($query);

set_message("USER CREATED");

redirect("index.php?users");



}



}





function get_reports(){


$query = query(" SELECT * FROM reports");
confirm($query);

while($row = fetch_array($query)) {


$report = <<<DELIMETER

        <tr>
             <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_title']}
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href="../adminportal/resources/templates/back/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $report;


        }





}




/******************Slides Functions *******************/

function add_slides() {


if(isset($_POST['add_slide'])) {


$slide_title        = escape_string($_POST['slide_title']);
$slide_image        = escape_string($_FILES['file']['name']);
$slide_image_loc    = escape_string($_FILES['file']['tmp_name']);


if(empty($slide_title) || empty($slide_image)) {

echo "<p class='bg-danger'>This field cannot be empty</p>";


} else {



move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS . $slide_image);

$query = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}', '{$slide_image}')");
confirm($query);
set_message("Slide Added");
redirect("index.php?slides");





                }


        }


}



function get_current_slide_in_admin(){

$query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
confirm($query);

while($row = fetch_array($query)) {

$slide_image = display_image($row['slide_image']);

$slide_active_admin = <<<DELIMETER



    <img class="img-responsive" src="../resources/{$slide_image}" alt="">



DELIMETER;

echo $slide_active_admin;


    }



}




function get_active_slide() {

$query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
confirm($query);



while($row = fetch_array($query)) {

$slide_image = display_image($row['slide_image']);

$slide_active = <<<DELIMETER


 <div class="item active">
    <img class="slide-image" src="../resources/{$slide_image}" alt="">
</div>


DELIMETER;

echo $slide_active;


    }

}



function get_slides() {

$query = query("SELECT * FROM slides");
confirm($query);



while($row = fetch_array($query)) {

$slide_image = display_image($row['slide_image']);

$slides = <<<DELIMETER


 <div class="item">
    <img class="slide-image" src="../resources/{$slide_image}" alt="">
</div>


DELIMETER;

echo $slides;




}




 
}


function get_slide_thumbnails(){


$query = query("SELECT * FROM slides ORDER BY slide_id ASC ");
confirm($query);

while($row = fetch_array($query)) {

$slide_image = display_image($row['slide_image']);

$slide_thumb_admin = <<<DELIMETER


<div class="col-xs-6 col-md-3 image_container">
    
    <a href="index.php?delete_slide_id={$row['slide_id']}">
        
         <img  class="img-responsive slide_image" src="../resources/{$slide_image}" alt="">


    </a>

    <div class="caption">

    <p>{$row['slide_title']}</p>

    </div>


</div>


    
DELIMETER;

echo $slide_thumb_admin;

    }
}

function get_products_in_customer(){

    $query = query(" SELECT * FROM products");
    confirm($query);
    
    while($row = fetch_array($query)) {
    
    $category = show_product_category_title($row['product_category_id']);
    
    $product_image = display_image($row['product_image']);
    
    $product = <<<DELIMETER
    
            <tr>
                <td>{$row['product_id']}</td>
    
                <td>
    
                 <p>{$row['product_title']}</p>
    
                <div>
    
                <img width='100' src="http://placehold.it/300/300" alt="">
    
                </div>
    
    
    
    
                </td>
    
    
                <td>{$category}</td>
                <td>{$row['product_price']}</td>
                <td>{$row['product_quantity']}</td>
                <td><a class= "btn btn-danger" href="../resources/templates/back/cart.php?id={$row['product_id']}">Add to cart<span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
    
DELIMETER;
    
    echo $product;
    
    
            }    
}



/**********************Complain******************************/
function add_complaint() {

    if(isset($_POST['complaint'])) {
    
        $complain   = escape_string(strip_tags($_POST['complain']));
    $email = ' ';
    if (isset($_SESSION['email'])){ 
    
        $email = $_SESSION['email'];
      }
    
    $query = query("INSERT INTO complaint (cusemail, complaint) 
    VALUES('{$email}','{$complain}')");
    confirm($query);
    set_message("Your complaint recorded");
    redirect("complaint.php");
    }
}

function get_complaints(){

    $query = query(" SELECT * FROM complaint");
    confirm($query);
    
    while($row = fetch_array($query)) {

    $complaint = <<<DELIMETER
    
            <tr>
                <td>{$row['complaintid']}</td>
                <td>{$row['cusemail']}</td>
                <td>{$row['complaint']}</td>
                 <td><a class="btn btn-danger" href= "../adminportal/resources/templates/back/resolvecomplain.php?id={$row['complaintid']}" >Resolve<span class= "glyphicon glyphicon-remove"></span></a></td>
            </tr>
    
DELIMETER;
    echo $complaint;
    
        }
    }

    function cart_products(){
        $email = 'k164008@nu.edu.pk';
        // $email = $_SESSION['email'];
        

        $query = query("SELECT cart.productid, cart.totalamount, products.product_image, products.product_title, products.product_category_id, cart.product_quantity, products.product_price from cart, products where products.product_id = cart.productid and cusemail = 'k164008@nu.edu.pk'");
        confirm($query);
        $amount = 0;
        while($row = fetch_array($query)) {
        
        $category = show_product_category_title($row['product_category_id']);
        
        $product_image = display_image($row['product_image']);
        
        $product = <<<DELIMETER
        
                <tr>
                    <td>{$row['productid']}</td>
        
                    <td>
                    
             <p>{$row['product_title']}</p>

                    <div> <img width='100' src="http://placehold.it/300/300" alt=""> </div>
                    </td>
        
        
                    <td>{$category}</td>
                    <td>{$row['product_price']}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$row['totalamount']}</td>
                    
                </tr>
        
DELIMETER;
                    $amount = $amount+$row['totalamount'];
        echo $product;
                }
                echo "<br/><br/><br/>Total amount is:  $".$amount;     
        }

 ?>
