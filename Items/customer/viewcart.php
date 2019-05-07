
<h1 class="page-header">
   All Products

</h1>

<h3 class="bg-success"><?php
include('functions.php');
 display_message(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Product Id</th>
           <th>Name</th>
           <th>Catagory</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Total amount</th>
      </tr>
    </thead>
    <tbody>

      
      <?php cart_products(); ?>


  </tbody>
</table>