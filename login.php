<?php  
session_start();

if (isset($_COOKIE["login"]) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE
    id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}  

require 'function.php';

if (isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    // var_dump($username);
    // var_dump($password);
    // die;


    $result = mysqli_query($conn, "SELECT * FROM user WHERE
        username = '$username'");
    if ( mysqli_num_rows($result)===1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){

            $_SESSION["login"] = true;
            
            if(isset($_POST['remember'])){

                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }

            header("Location: index.php");
            exit;
        }

    }
    $error = true;
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
    <title>Halaman login</title>
    <style>
        label{
            display: block;
        }
    </style>
  </head>
  <body>

    <div class="container  ">
        <div class="card position-absolute top-50 start-50 translate-middle " style="width: 40rem; ">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Halaman Login</h1>
                <?php if (isset($error)): ?>
                    <p style="color: red;">Username atau Password salah!</p>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">username :</label>
                        <div class="col-sm-4">
                            <input type="text" name="username" class="form-control" id="username">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">password :</label>
                        <div class="col-sm-4">
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="remember" class="col-sm-3 col-form-label">Remember me <input type="checkbox" name="remember" id="remember"></label>
                    </div>
                    <div class="row">
                        <a href="register.php"><p>Belum memiliki akun? Registrasi disini</p></a>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary text-start">Login!</button>
                </form>
            </div>
        </div>
    </div>
            

            



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>