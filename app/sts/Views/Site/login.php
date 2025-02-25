<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL; ?>app/sts/assets/adm/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="app/sts/assets/adm/css/login.css">
</head>

<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

//echo password_hash("123456a", PASSWORD_DEFAULT);
?>

<body>
    <div class="container">
        <div class="left-column"><img src="app/sts/assets/adm/img/loginSide2.jpg" alt=""></div>
        <div class="right-column">
            <label class="welcome-label">Bem-vindo de volta!</label>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <span id="msg"></span>
            <form method="POST" action="" class="user" id="form-login">
                <div class="form-group">
                    <?php
                    $email = "";
                    if (isset($valorForm['email'])) {
                        $email = $valorForm['email'];
                    }
                    ?>
                    <input type="email" name="email" id="email exampleInputEmail" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Digite o seu email..." value="<?php echo $email ?>" required>
                </div>
                <div class="form-group">
                    <?php
                    $password = "";
                    if (isset($valorForm['password'])) {
                        $password = $valorForm['password'];
                    }
                    ?>
                    <input type="password" name="password" id="password exampleInputPassword" class="form-control form-control-user" placeholder="Digite a sua Senha..." value="<?php echo $password ?>" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="rememberMe" name="rememberMe">
                    <label for="rememberMe">Lembre-se de mim</label>
                </div>
                <button type="submit" name="SendLogin" value="Registar">Entrar</button>
            </form>
            <hr class="separator">
            <div class="links">
                <a href="forgot-password.html">Esqueceu a Senha?</a>
                <a href="<?php echo URL; ?>new-user/index">Criar Conta!</a>
            </div>
        </div>
    </div>
</body>

</html>