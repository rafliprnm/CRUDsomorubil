<?php  

require 'function.php';

if (isset($_POST["register"])){
    if (registrasi($_POST) > 0){
        echo "
                <script>
                    alert('user baru berhasil ditambahkan!')
                    
                </script>
            ";  
    }else{
        echo mysqli_error($conn);
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
    <title>Halaman Registrasi</title>
    <style>
        label{
            display: block;
        }
    </style>
  </head>
  <body>
    <div class="container ">
        <div class="card position-absolute top-50 start-50 translate-middle " style="width: 40rem; ">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Halaman Registrasi</h1>
                <form action="" method="post">
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">username :</label>
                        <div class="col-sm-4">
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">email :</label>
                        <div class="col-sm-4">
                            <input type="text" name="email" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">password :</label>
                        <div class="col-sm-4">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password2" class="col-sm-2 col-form-label">Konfirmasi:</label>
                        <div class="col-sm-4">
                            <input type="password2" name="password2" class="form-control" id="password2">
                        </div>
                    </div>
                    <div class="row">
                        <a href="login.php"><p>Sudah memiliki akun? Login disini</p></a>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary text-start">register!</button>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>