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
          <title>Welcome To Only Shopping Store</title>
         
    </head>

    <?php 
include('functions.php'); ?>

<h1 class="page-header">
</h1>

<h3 class="bg-success"><?php 
display_message();?></h3>
<table class="table table-hover">

<?php 
add_complaint(); ?>
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   Complaint
</h1>
</div>

<form action="" method="post" enctype="multipart/form-data">

<div class="col-md-8">


    <div class="form-group">
           <label for="product-title">Add complaint here</label>
      <textarea name="complain" id="" cols="30" rows="10" class="form-control">1-499</textarea>
    </div>

</div>

<aside id="admin_sidebar" class="col-md-4">

     <div class="form-group">
        <input type="submit" name="complaint" class="btn btn-primary btn-lg" value="Submit">
    </div>

</aside>
</form>