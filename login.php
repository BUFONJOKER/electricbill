<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_POST['user'];
    $password = $_POST['password'];
    if($user =="admin@gmail.com" && $password == "admin123"){
        $_SESSION['user'] = $user;
        echo '
        <div class="alert alert-success" role="alert">
            Admin logged in successfully
        </div>';

        echo '<script>
            setTimeout(function () {
                document.querySelector(".alert").style.display = "none";
                window.location.href = "view_customers.php";
            }, 1000);
        </script>';
        // header("location: index.php");
    }
    else{
        echo "user not found";
    }
    

}
?>



<!DOCTYPE html>
<html lang="en">

<?php include("head.php");?>

<body class='bg-black'>
    <div class="text-center m-5">
        <img class="mx-auto" src="images/logo.png" alt="" height="100">
        <h1 class=" m-5 text-white">Admin Login</h1>
    </div>
    <div class="container text-white text-center">
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="user" class="form-label fs-3 fw-bold">Email address</label>
                <input name="user" class="form-control w-50 mx-auto" type="email" id="user" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" class="form-control w-50 mx-auto" type="password" id="password" aria-describedby="emailHelp">
            </div>

            <button class="btn btn-primary fs-3" type="submit">Login</button>
        </form>
    </div>
</body>

</html>