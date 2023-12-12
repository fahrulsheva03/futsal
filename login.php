<?php
session_start();
require "functions.php";


if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role == "Admin") {
    header("Location: admin/home.php");
  } else {
    header("Location: user/lapangan.php");
  }
}

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $data = mysqli_query($conn,"SELECT * FROM user WHERE email='$email' AND password='$password'");


  // $cariuser = query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");  
  $cek = mysqli_num_rows($data);
	$akun = mysqli_fetch_assoc($data);
  
  if($akun['email'] == $email && $akun['password'] == $password ){
		if($akun['verif'] == 1){
      // set session
    $_SESSION['email'] = $akun['email'];
    $_SESSION['id_user'] = $akun['id_user'];
    $_SESSION['role'] = "User";
    header("Location: user/lapangan.php");

			  // $_SESSION["user"] = $akun;
			  // Jika Sudah, maka  di arahkan ke tampilan Utama
      }else{
			echo "
      <script>
				  alert('Belum Verif');
				  window.history.back();
			  </script>";
      }
    }else{
      // Jika Gagal, maka akan kembali ke Halaman Login
      echo "
      <script>
      alert('Login Gagal, Gmail dan Password Salah');
      window.history.back();
      </script>";
    }
    
    $cariadmin = query("SELECT * FROM admin WHERE email = '$email' AND password = '$password'");
    
    if ($cariadmin) {
      
    // set session
    $_SESSION['username'] = $cariadmin[0]['nama'];
    $_SESSION['role'] = "Admin";
    header("Location: admin/admin.php");

  } else {
    echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
  }
}


?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login Sport Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body class="login">
  <div class="center">
    <h1>Login</h1>
    <form method="POST">
      <div class="txt_field">
        <input type="gmail" name="email" required>
        <span></span>
        <label>Email</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Password</label>
      </div>
      <div class="pass">Lupa Sandi?</div>
      <button class="button btn-inti" name="login" id="login">Login</button>
      <div class="signup_link">
        Belum punya akun? <a href="user/daftar.php">Daftar</a>
      </div>
    </form>
  </div>

</body>

</html>