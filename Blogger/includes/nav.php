   <?php include_once 'db_guys/db_categories.php' ?>
   <!-- Navigation -->
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
       <div class="container">
           <!-- Brand and toggle get grouped for better mobile display -->
           <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                   <span class="sr-only">Toggle navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="./">CMS Home</a>
           </div>
           <!-- Collect the nav links, forms, and other content for toggling -->
           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
                   <li><a href="admin/"><b>ADMIN</b></a></li>
                   <li <?php echo $_SERVER['REQUEST_URI'] == '/login.php' ? 'class="active"' : '' ?>><a href="login.php"><b>LOGIN</b></a></li>
                   <li <?php echo $_SERVER['REQUEST_URI'] == '/registration.php' ? 'class="active"' : '' ?>><a href="registration.php"><b>SIGN UP</b></a></li>
                   <li <?php echo $_SERVER['REQUEST_URI'] == '/contact.php' ? 'class="active"' : '' ?>><a href="contact.php"><b>CONTACT US</b></a></li>
                   <?php NavBarCategories() ?>
               </ul>
           </div>
           <!-- /.navbar-collapse -->
       </div>
       <!-- /.container -->
   </nav>

   <?php
    function NavBarCategories()
    {

        foreach (GetCategories() as $c) { ?>
           <li <?php echo  $_SERVER['REQUEST_URI'] == '/category.php?id=' . $c['cat_id'] ? 'class="active"' : '' ?>><a href="category.php?id=<?php echo $c['cat_id'] ?>"><?php echo $c['cat_title'] ?></a></li>;
   <?php
        }
    }
    ?>