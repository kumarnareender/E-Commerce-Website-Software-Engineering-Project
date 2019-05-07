
<br> 
<h1 class="page-header">
   Customers Complains
</h1></br>

<h3 class="bg-success"><?php display_message(); ?></h3>
<table class="table table-hover">
 

    <thead>
 
      <tr>
           <th>Complain Number</th>
           <th>Customer Name</th>
           <th>Complaint</th>
      </tr>
    </thead>
    <tbody>      
      <?php get_complaints(); ?>


  </tbody>
</table>