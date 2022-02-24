<?php  
session_start();

if ( !isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'function.php';

$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM mobil")); 
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
if (isset($_GET["halaman"])){
  $halamanAktif = $_GET["halaman"];
}else{
  $halamanAktif = 1;
}
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mobil = query("SELECT * FROM mobil LIMIT $awalData, $jumlahDataPerHalaman");


if (isset($_POST["cari"])){
  $mobil = cari($_POST["keyword"]);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/main.css">
    <title>Halaman Admin</title>
  </head>
  <body>
    <div class="container mt-3">
      <h1 class="text-center">Daftar Mobil</h1>
      <div class="row">
        <div class="col">
          <form action="" method="post" class="mb-3">
            <div class="input-group">
              <input type="text" name="keyword" size="30" height="20"
              autofocus placeholder=" Masukkan Keyword pencarian..." autocomplete="off">
              <button class="btn btn-secondary" type="submit" name="cari"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>
        <div class="col text-end">
          <a class="btn btn-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </div>
      </div>
      <table class="table table-dark table-hover table-bordered border-light">
                <tr class="text-center fs-4">
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Nama Mobil</th>
                    <th>Merek</th>
                    <th>Jenis</th>
                    <th>Warna</th>
                    <th>tahun</th>
                    <th>Harga</th>
                    <th></th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($mobil as $row ) :?>
                <tr class="align-middle text-center fs-5">
                    <td><?php echo $i; ?></td>
                    <td > 
                        <img src= "img/<?php echo $row["gambar"];  ?>" alt="" width="auto" height="200px">
                    </td>
                    <td><?php echo $row["nama"]; ?></td>
                    <td><?php echo $row["merk"]; ?></td>
                    <td><?php echo $row["jenis"]; ?></td>
                    <td><?php echo $row["warna"]; ?></td>
                    <td><?php echo $row["tahun"]; ?></td>
                    <td>Rp. <?php echo $row["harga"]; ?></td>
                    <td>
                      <a class= "text-dark btn btn-edit m-1" href="ubah.php?id=<?php echo $row["id"];?>"><i class="bi bi-pencil-square"></i></a>
                      <a class="text-dark btn btn-danger" href="hapus.php?id=<?php echo $row["id"];?> "onclick="return confirm('Yakin ingin menghapus data?')";><i class="bi bi-trash3-fill"></i></a>
                      
                    </td>
                    <?php $i++; ?>
                </tr>
                <?php endforeach; ?>
      </table>
      <div class="text-center">
        <a class="" href="tambah.php"><i class="bi bi-plus-circle-fill fs-1"></i></a>
        <p>Klik icon "+" untuk menambahkan data</p>
      </div>
      
      <div class="halaman text-center">
        <?php if($halamanAktif > 1) : ?>
        <a class="btn btn-dark" href="?halaman= <?php echo $halamanAktif-1; ?>">Prev</a>
        <?php endif; ?>

        <?php for($i=1; $i <= $jumlahHalaman; $i++) : ?>
          <?php if ($i==$halamanAktif): ?>
            <a class="btn btn-dark" href="?halaman= <?php echo $i; ?>" style="font-weight: bold; color:blue"><?php echo $i ?></a>
          <?php else: ?>
            <a class="btn btn-dark" href="?halaman= <?php echo $i; ?>"><?php echo $i ?></a>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if($halamanAktif < $jumlahHalaman) : ?>
          <a class="btn btn-dark" href="?halaman= <?php echo $halamanAktif+1; ?>">Next</a>
        <?php endif; ?>
      </div>
    </div>

    

    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>