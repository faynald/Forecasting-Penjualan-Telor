<?php
include("connection.php");
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$select = mysqli_query($connection, "SELECT * FROM user WHERE USERNAME='$username' && PASSWORD='$password'");
$num = mysqli_num_rows($select);

if ($num == 0) {
?>
    <script>
        alert("Username atau Password Salah !");
        document.location = "../login.php";
    </script>
<?php
} else {
    while ($data = mysqli_fetch_array($select)) {
        $_SESSION["username"] = $data["username"];
        $_SESSION["nama"] = $data["nama_user"];
        $_SESSION['tahun'] = 2021;
        $_SESSION['bulan'] = 'Juni';
        $_SESSION['tahun_grafik'] = 2021;
        $_SESSION['tipe_telur'] = 'telur_ayam_kampung';
    }
    header("location:../index.php");
}
?>