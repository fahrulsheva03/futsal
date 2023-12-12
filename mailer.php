<?php 
require "functions.php";


use PHPMailer\PHPMailer\PHPMailer ; 
use PHPMailer\PHPMailer\Exception ; 


$email = $_POST['email'];
$username = $_POST['nama'];

$kode = "<a href='http://localhost/pulsaa/verif.php?gmail=$email'>Verif Di Sini</a>";
    

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['daftar'])){


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host= 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'fahrulshevavanjovie@gmail.com';
    $mail->Password = 'aakt bqwt ybfj ykou ';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom("admin@gmail.com");

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = "Verifikasi";

    $mail->Body = "Haloo $username, Silahkan verif di sini  $kode";

    $cekemail = $email; // Ganti dengan email yang diinputkan dari form
    $sql = mysqli_query($conn , "SELECT * FROM user WHERE email='$cekemail'");
    
    

    if(mysqli_num_rows($sql) > 0 ){
        echo "
        <script>
        alert('Email Sudah Terdaftar')
        document.location.href='user/daftar.php';
        </script>
        "; 
    }else{
    
    // Masukan Data Ke Database
    if (daftar($_POST) > 0) {
        echo "<div class='alert alert-success'>Berhasil mendaftar, silakan login.</div>
                <meta http-equiv='refresh' content='2; url= login.php'/>  ";
      }
    }



    

}
