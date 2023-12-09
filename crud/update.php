<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // Cek apakah ada nilai yang dikirim menggunakan metode GET dengan nama id_peserta
if (isset($_GET['id_peserta'])) {
    $id_peserta = input($_GET["id_peserta"]);

    // Ambil data dari database
    $sql = "SELECT * FROM peserta WHERE id_peserta=$id_peserta";
    $hasil = mysqli_query($kon, $sql);
    $data = mysqli_fetch_assoc($hasil);
}

// Cek apakah ada kiriman form dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peserta = htmlspecialchars($_POST["id_peserta"]);
    $nama = input($_POST["nama"]);
    $kelas = input($_POST["kelas"]);
    $jurusan = input($_POST["jurusan"]);
    $fakultas = input($_POST["fakultas"]);
    $no_hp = input($_POST["no_hp"]);

    // Membuat query update yang benar
    $sql_update = "UPDATE peserta SET nama='$nama', kelas='$kelas', jurusan='$jurusan', fakultas='$fakultas', no_hp='$no_hp' WHERE id_peserta=$id_peserta";

    // Mengeksekusi atau menjalankan query diatas
    $hasil = mysqli_query($kon, $sql_update);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hasil) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }
}

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama :</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
        
        </div>
        <div class="form-group">
            <label>Kelas:</label>
            <input type="text" name="kelas" class="form-control" placeholder="Masukan Kelas" required/>
        </div>   
        <div class="form-group">
            <label>Jurusan :</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" required/>
        </div>
        <div class="form-group">
            <label>Fakultas :</label> 
            <input type="text" name="fakultas" class="form-control" placeholder="Masukan Fakultas" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>     

        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>