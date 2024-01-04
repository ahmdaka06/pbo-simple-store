<?php
require '../connect.php';

// check if has session admin redirect to dashboard
if (isset($_SESSION['is_admin']) AND $_SESSION['is_admin']) {
    redirect('admin/dashboard.php');
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query check admin
    $check = $database->query("SELECT * FROM users WHERE `username` = '$username' AND `role` = 'admin' LIMIT 1");

    if ($check->num_rows > 0) { // check if users exists
        $user = $check->fetch_assoc(); // fetch data user

        // check if user password not valid using bcrypt 
        if (password_verify($password, $user['password']) == false) {
            alert('Data admin tidak sesuai');
        } else {
            $_SESSION['is_admin'] = true;
            $_SESSION['user'] = $user;
            redirect('admin/dashboard.php');
            alert('Login berhasil!.');
            
        }
    } else {
        // set alert if user not exists
        alert('Data admin tidak tersedia');
    }
}
include '../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"> Login</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
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
include '../layouts/footer.php';
?>