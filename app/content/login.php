<?php
include '../templates/headerlogin.php';
?>

<div class="container bg-card-login shadow-lg">
    <!-- Start Row -->
    <div class="row">
        <!-- Start First COlumn -->
        <div class="col-md-6 pict-card in-card">
            <img src="<?= URL; ?>assets/img/pictlogin.jpg" alt="" class="img img-fluid">
        </div>
        <!-- End First Column -->
        <!-- Start Second Column -->
        <div class="col-md-6 in-card">
            <h1 class="display-4 login-title text-center mb-5">
                Login
            </h1>
            <div class="container">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username_user" class="form-label">Username</label>
                        <input type="text" class="form-control input-login" id="username_user"  required="true" name="username_user" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password_user" class="form-label">Password</label>
                        <input type="password" class="form-control input-login" id="password_user" required="true" name="password_user">
                    </div>
                    <button class="btn btn-success btn-block mt-5" name="btnLoginUser" value="" type="submit">
                        Login
                    </button>
                </form>
                <p class="text-center  mt-5">
                    <a href="register.php" class="text-createaccount">
                        Belum punya akun? Registrasi Di sini!
                    </a>
                </p>
            </div>
        </div>
        <!-- End Second Columns -->
    </div>
    <!-- End Row -->
</div>

<?php
if (isset($_POST['btnLoginUser'])) {
    $username_user = $_POST['username_user'];
    $password_user = $_POST['password_user'];
    $user = $objUser->verifyBeforeLoginUser($username_user);
    if ($user==NULL) {
        //belum ada akun silahkan daftar
        $objFlash->showSimpleFlash("LOGIN GAGAL","warning","Username tidak ada, silahkan daftar akun terlebih dahulu!","login.php",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
    }else{
        if (password_verify($password_user, $user['password_user'])) {
            //bisa login
            $_SESSION['user'] = $user;
             $objFlash->showSimpleFlash("LOGIN BERHASIL","success","Anda berhasil login!","index.php",$confirmButtonColor="#4BB543",$cancelButtonColor = "#d33","Login");
        }else{
            //password salah
             $objFlash->showSimpleFlash("LOGIN GAGAL","warning","Password Salah!","login.php",$confirmButtonColor="#d33",$cancelButtonColor = "#d33","Kembali");
        }
    }
}
?>

<?php
include '../templates/footerlogin.php';
?>