<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">Admin</a>

</div>


<!-- Top Menu Items -->
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