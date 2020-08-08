
<?php require_once("resources/config.php"); ?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

    <!--Top_items-->
    <?php include(TEMPLATE_BACK . "/top_nav.php"); ?>

         
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
   <?php include(TEMPLATE_BACK . "/side_nav.php"); ?>
        </nav>



        <div id="page-wrapper">

            <div class="container-fluid">

             


              <?php 

                if($_SERVER['REQUEST_URI'] == "/project/items/adminportal/" || $_SERVER['REQUEST_URI'] == "/project/items/adminportal/index.php")  {


                    include(TEMPLATE_BACK . "/admin_content.php");

                }


                if(isset($_GET['orders'])){


                    include(TEMPLATE_BACK . "/orders.php");


                }

                if(isset($_GET['categories'])){


                    include(TEMPLATE_BACK . "/categories.php");


                }

                 if(isset($_GET['products'])){


                    include(TEMPLATE_BACK . "/products.php");


                }


                 if(isset($_GET['add_product'])){


                    include(TEMPLATE_BACK . "/add_product.php");


                }



                if(isset($_GET['add_item'])){


                    include(TEMPLATE_BACK . "/add_item.php");


                }    

                 if(isset($_GET['edit_product'])){


                    include(TEMPLATE_BACK . "/edit_product.php");


                }

                if(isset($_GET['users'])){


                    include(TEMPLATE_BACK . "/users.php");


                }


                if(isset($_GET['add_user'])){


                    include(TEMPLATE_BACK . "/add_user.php");


                }


                 if(isset($_GET['edit_user'])){


                    include(TEMPLATE_BACK . "/edit_user.php");


                }


                  if(isset($_GET['reports'])){


                    include(TEMPLATE_BACK . "/reports.php");


                }



                 if(isset($_GET['slides'])){


                    include(TEMPLATE_BACK . "/slides.php");


                }


                 if(isset($_GET['delete_order_id'])){


                    include(TEMPLATE_BACK . "/delete_order.php");


                }

                 if(isset($_GET['delete_product_id'])){


                    include(TEMPLATE_BACK . "/delete_product.php");


                }

                 if(isset($_GET['delete_category_id'])){


                    include(TEMPLATE_BACK . "/delete_category.php");


                }


                 if(isset($_GET['delete_report_id'])){


                    include(TEMPLATE_BACK . "/delete_report.php");


                }

                 if(isset($_GET['delete_user_id'])){


                    include(TEMPLATE_BACK . "/delete_user.php");


                }


                 if(isset($_GET['delete_slide_id'])){


                    include(TEMPLATE_BACK . "/delete_slide.php");


                 }

                if(isset($_GET['complaint'])){
 

                    include(TEMPLATE_BACK . "/complaint.php");
                    
                    
                    }
      


                 ?>
             

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include(TEMPLATE_BACK . "/footer.php"); ?>
