<?php  
$conn = mysqli_connect("localhost", "root", "", "data_mobil");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $nama =htmlspecialchars( $data["nama"]);
    $merk =htmlspecialchars( $data["merk"]);
    $jenis =htmlspecialchars( $data["jenis"]);
    $warna =htmlspecialchars( $data["warna"]);
    $tahun =htmlspecialchars( $data["tahun"]);
    $harga =htmlspecialchars( $data["harga"]);

    $gambar = upload();
    if (!$gambar){
        return false;
    }

    $query = "INSERT INTO mobil
                VALUES
              (0, '$nama', '$merk', '$jenis', '$warna', '$tahun', '$harga', '$gambar')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error == 4){
        echo "
            <script>
                alert('Pilih Gambar Terlebih Dahulu!');
            </script>
            ";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
            <script>
                alert('Yang anda upload bukan file gambar!');
            </script>
            ";
        return false;
    }

    // if ($ukuranFile > 1000000){
    //     echo "
    //         <script>
    //             alert('Ukuran gambar terlalu besar!');
    //         </script>
    //         ";
    //     return false;
    // }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
    return $namaFileBaru;

}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mobil WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;
    $id = $data["id"];
    $nama =htmlspecialchars( $data["nama"]);
    $merk =htmlspecialchars( $data["merk"]);
    $jenis =htmlspecialchars( $data["jenis"]);
    $warna =htmlspecialchars( $data["warna"]);
    $tahun =htmlspecialchars( $data["tahun"]);
    $harga =htmlspecialchars( $data["harga"]);
    $gambarLama =htmlspecialchars( $data["gambarLama"]);

    if($_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    $query = " UPDATE mobil SET
                nama = '$nama',
                merk = '$merk',
                jenis = '$jenis',
                warna = '$warna',
                tahun = '$tahun',
                harga = '$harga',
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM mobil 
                WHERE 
            nama LIKE '%$keyword%' OR 
            merk LIKE '%$keyword%' OR
            jenis LIKE '%$keyword%' OR
            warna LIKE '%$keyword%' OR
            tahun LIKE '%$keyword%' OR
            harga LIKE '%$keyword%'
            ";
    return query($query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $resultUsername = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($resultUsername)){
        echo "
                <script>
                    alert('username sudah terdaftar!')
                </script>
            ";
        return false;
    }

    $resultEmail = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    if (mysqli_fetch_assoc($resultEmail)){
        echo "
                <script>
                    alert('email sudah terdaftar!')
                </script>
            ";
        return false;
    }

    if ( $password !== $password2){
        echo "
                <script>
                    alert('Konfirmasi password tidak sesuai!')
                    
                </script>
            "; 
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES (0,'$username', '$email', '$password')");
    
    return mysqli_affected_rows($conn);
}

?>