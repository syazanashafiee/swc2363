<header class="header">

   <div class="flex">
<img src="online.png" width="55" height="55" alt="bananabro"/>
      <a href="#" class="logo">BananaBro</a>

      <nav class="navbar">
         
         <a href="products.php">PRODUCTS</a>
		 <a href="cart.php">CART</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($connect, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>