
<nav class="navbar navbar-expand-lg navbar-dark warna1">
  <div class="container">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link" aria-current="page" href="customer_page/produk-cust.php">Product</a>
        </li>
        <li class="nav-item d-flex align-items-center" >
          <a class="nav-link" href="customer_page/profile.php"><i class="fa-solid fa-user-tag fa-xs" style="color: black;"></i></a>
          <a class="nav-link" href="customer_page/profile.php"><?php echo $_SESSION['username']; ?></a>
        </li>  
      </ul>


      <li class="nav-item me-4">
        <a class="navbar-brand" href="session/logout.php" tabindex="-1" aria-disabled="true">Logout</a>
        </li>
    </div>
  </div>
</nav>

