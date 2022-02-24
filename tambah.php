<?php  
session_start();

if ( !isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}

require 'function.php';

if (isset($_POST["submit"])) {
    // var_dump($_POST);
    
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!')
                document.location.href = 'index.php'
            </script>
        ";  
    }else{
        echo "
            <script>
                alert('data gagal ditambahkan!')
                
            </script>
        ";  
    }
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
    <title>Tambah Data Mobil</title>
  </head>
  <body>
    <div class="container">
    <div class="card mt-3 bg-light">
            <h1 class="card-header text-center">Tambah Data Mobil</h1>
            <a href="index.php" class="btn btn-primary fw-bold">Back to Home <i class="bi bi-house-door"></i></a>
            <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="m-3">
                        <label for="nama" class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="m-3">
                        <label for="merk" class="form-label">Merek Mobil</label>
                        <input type="text" class="form-control" name="merk" id="merk" required>
                    </div>
                    <div class="m-3">
                        <label for="jenis">Jenis Mobil</label>
                        <input type="text" class="form-control" name="jenis" id="jenis" required>
                    </div>
                    <div class="m-3">
                        <label for="warna" class="form-label">Warna Mobil</label>
                        <input type="text" class="form-control" name="warna" id="warna" required>        
                    </div>
                    <div class="m-3">
                        <label for="tahun" class="form-label">Tahun Mobil</label>
                        <input type="text" class="form-control" name="tahun" id="tahun" required>
                    </div>
                    <div class="m-3">
                        <label for="harga" class="form-label">Harga Mobil</label>
                        <input type="text" class="form-control" name="harga" id="harga" required>
                    </div>
                    <div class="m-3">
                        <label for="gambar" class="form-label">Gambar Mobil</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                    <div class="m-3">
                        <button class="btn btn-edit fw-bold" type="submit" name="submit">Tambah Data</button>
                        <a href="index.php" class="btn btn-danger fw-bold text-dark">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>