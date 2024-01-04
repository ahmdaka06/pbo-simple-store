<?php
require 'connect.php';

// check if has session customer redirect to dashboard
if (isset($_SESSION['is_customer']) AND $_SESSION['is_customer']) {
    redirect('dashboard.php');
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password with bcrypt

    // query check users
    $check = $database->query("SELECT * FROM users WHERE `username` = '$username' LIMIT 1");

    if ($check->num_rows > 0) { // check if users exists
        alert('Username telah terdaftar');
    } else {
        $register = $database->query("INSERT INTO `users`(`username`, `name`, `password`, `role`, `created_at`) VALUES ('$username','$name','$password','customer','$datetime')");
        if ($register) {
            alert('Register berhasil!.');
            redirect('login.php');
        } else {
            alert('Register gagal');
        }
    }
}
include 'layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Register</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="form-group col-md-12 my-1">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group col-md-12 my-1">
                            <button type="submit" class="btn btn-success" name="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
include 'layouts/footer.php';
?>