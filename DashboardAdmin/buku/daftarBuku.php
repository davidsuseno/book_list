<?php
require "../../config/config.php";
$buku = queryReadData("SELECT * FROM buku");
$kategori_buku = getAllCategories();
$kategoriBuku = isset( $_POST['kategori'] ) ? $_POST['kategori'] : null;

// mengaktifkan tombol search engine
if(isset($_POST["search"]) ) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $buku = search($_POST["keyword"]);
  
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Kelola buku || Admin</title>
  </head>
  <style>
    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }
  </style>
  <body>
  <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../../assets/logoPustakawan.png" alt="logo" width="120px">
        </a>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../dashboardAdmin.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success" href="tambahBuku.php">Tambah Buku</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<form action="" method="post" class="mt-5">
  <div class="row">
    <div class="p-4 mt-4">
      <!--search engine --->
    
       <div class="input-group d-flex justify-content-end mb-3">
         <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="Cari buku kamu...">
         <button class="btn btn-info" type="submit" name="search">Cari</i> </button>
       </div>
       <div class="input-group d-flex justify-content-end mb-3">
            <select class="form-select form-select-lg mb-3" aria-label="Default select example">
              <?php foreach( $kategori_buku as $category) : ?>
                <option><?= $category['kategori']?><?php if($kategoriBuku['kategori'] == $kategori_buku): echo ' selected'; endif;?></option>
                <?php endforeach; ?>
            </select>
      
       
       <!--Card buku-->
       <div class="layout-card-custom">
       <?php foreach ($buku as $item) : ?>
       <div class="card" style="width: 15rem;">
         <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
         <div class="card-body">
           <h5 class="card-title"><?= $item["judul"]; ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
            <li class="list-group-item">Judul : <?= $item["judul"]; ?></li>
            <li class="list-group-item">Penulis : <?= $item["pengarang"]; ?>
          </ul>
        <div class="card-body">
          <a class="btn btn-info" href="updateBuku.php?idReview=<?= $item["id_buku"]; ?>" id="review">Edit</a>
          
          <a class="btn btn-danger" href="deleteBuku.php?id=<?= $item["id_buku"]; ?>" onclick="return confirm('Yakin ingin menghapus data buku ? ');">Delete</a>
          </div>
        </div>
       <?php endforeach; ?>
        </div>
      </div>
  </div>
</form>

      <footer class="shadow-lg bg-subtle p-3">
      <div class="container-fluid d-flex justify-content-between">
      <p class="mt-2">Book List <span class="text-primary"> Pustakawan</span> © </p>
      <p class="mt-2">versi 1.0</p>
      </div>
    </footer>
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>