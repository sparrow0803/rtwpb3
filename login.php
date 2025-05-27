<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'rtwpb3');

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $query = "SELECT * from admin where username='$username'";
    $result = mysqli_query($conn, $query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $pass = $row['password'];

            if(password_verify($_POST['password'], $pass)){
                $_SESSION['admin'] = $username;
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_panel.php');
            }
            else{
                $_SESSION['error'] = "Invalid Password";
            }
        }
        else{
            $_SESSION['error'] = "Invalid Credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RTWPB3 Admin Panel Login</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
        background: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png'), #e9ecef;
        background-size: cover;
        background-repeat: repeat;
        margin: 0;
        padding: 0;
    }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="background-color: #043047; width: 750px; height: 450px; color: white; border-radius: 10px;">
        <div class="row h-100 align-items-center">
            <div class="col-md-6 text-center">
                <img src="images/logo.png" class="img-fluid" style="max-height: 200px;" alt="Logo">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4 text-white text-center">RTWPB3 ADMIN PANEL</h2>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" autofocus="true" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="text-center"> 
                        <button type="submit" class="btn" name="login" style="background-color: white; color: #043047;">Log In</button>
                    </div>

                    <div class="text-center">
                    <a href="index.php" style="font-size: 7px;" class="text-white text-center text-decoration-none">Go to offical website <i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SWEETALERT -->
<?php
  if(isset($_SESSION['success'])) { ?>
  <script>
    Swal.fire({
    title: "<?php echo $_SESSION['success']; ?>",
    icon: "success",
    confirmButtonText: 'OK',
    confirmButtonColor: "#043047",
    });
  </script>
<?php unset($_SESSION['success']); } ?>

<?php
  if(isset($_SESSION['error'])) { ?>
  <script>
    Swal.fire({
    title: "<?php echo $_SESSION['error']; ?>",
    icon: "error",
    confirmButtonText: 'OK',
    confirmButtonColor: "#043047",
    });
  </script>
<?php unset($_SESSION['error']); } ?>

<!-- REFRESH -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
</body>
</html>