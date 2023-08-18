<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item me-4">
          <a class="nav-link" href="kategori.php">Kategori</a>
        </li>

        <li class="nav-item me-4">
          <a class="nav-link active" aria-current="page" href="produk.php">Produk</a>
        </li>

        <li class="nav-item me-4">
          <a class="nav-link" href="pesanan.php">Pesanan</a>
        </li>
        
        <li class="nav-item me-4 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="graph.php">Grafik Penjualan</a></li>
            <li><a class="dropdown-item" href="pembelian_prdk.php">Pembelian</a></li>
            <li><a class="dropdown-item" href="receipt.php">Barang</a></li>
            <li><a class="dropdown-item" href="buktibyr.php">Bukti Bayar</a></li>
            <li><a class="dropdown-item" href="progress.php">Proggress Pesanan</a></li>
            <li><a class="dropdown-item" href="customer-table.php">Riwayat Customers</a></li>
            <li><a class="dropdown-item" href="feedback_customer.php">Feedback Customer</a></li>
            <li class="dropdown dropright">
              <a class="dropdown-item dropdown-toggle" href="#" role="button" id="nestedDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">Order</a>
              <ul class="dropdown-menu" aria-labelledby="nestedDropdown">
                <li><a class="dropdown-item" href="data_penjualan.php">Order Selesai</a></li>
                <li><a class="dropdown-item" href="data_penjualan_un.php">Order Belum Selesai</a></li>
                <li><a class="dropdown-item" href="data_reject.php">Order Ditolak</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="../session/logout.php" tabindex="-1" aria-disabled="true">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
  // Prevent dropdown from closing when clicking inside the nested dropdown
  const nestedDropdown = document.querySelector('.dropdown.dropright');
  nestedDropdown.addEventListener('click', (e) => {
    e.stopPropagation();
  });
</script>