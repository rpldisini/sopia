<?php
session_start();

   if (isset($_SESSION['login'])) {
         header ("location:dashboard.php");
         exit;
   }

  $error = "";

  if (isset($_POST['login'])) {
    
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === "admin" && $password === "12345") {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;

            header("location: dashboard.php");
            exit;

        } else {

            $error = "Username atau password salah";
        }
}
?>

<!DOCTYPE html>
<html lang="id">

 <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Login - Absesnsi sekolah</title>

        <link rel="stylesheet" href="style.css">
    </head>

<body class="login-page">

<div class="login-box">

    <img src="logo.png" class="logo" alt="logo sekolah">

    <h2>ABSENSI SEKOLAH</h2>

    <p>silahkan login untuk masuk</p>

    <?php if  ($error != "") { ?>

        <div class="error">
             <?= $error; ?>
        </div>

    <?php } ?>

    <form method="POST">

        <label>Username</label>

        <input
            type="text"
            name="username"
            placeholder="masukkan username"
            required
        >

        <label>password</label>

        <input
        type="password"
        name="password"
        placeholder="masukkan password"
        required
    >

    <button type="submit" name="login">
        LOGIN
    </button>
    
</form>

  <div class="info-login">
        username : <b>admin </b><br>
        password : <b>12345</b>
    </div>

</div>

</body>
</html>