<?php
include 'connect.php';

// $id = $_GET['id'];
$email = $_GET['gmail'];

$query = mysqli_query($db , "UPDATE pengguna SET verif='1' WHERE gmail = '$email' " );

if($query){
    echo "
    <script>
    alert('Selamat Sudah Verif')
    document.location.href='login.php';
    </script>
    ";
}