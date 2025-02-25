<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL; ?>app/sts/assets/adm/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="<?php echo URL; ?>app/sts/assets/adm/css/new-user.css">
</head>

<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

//echo password_hash("123456a", PASSWORD_DEFAULT);
?>

<body>
    <div class="container">
        <div class="left-column">
            <img src=" <?php echo URL; ?>app/sts/assets/adm/img/novouser.jpg" class="animated-img" alt="">
        </div>
        <div class="right-column">
            <label class="welcome-label">Criar conta!</label>
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
                    $name = "";
                    if (isset($valorForm['name'])) {
                        $name = $valorForm['name'];
                    }
                    ?>
                    <input type="text" name="name" id="name" class="form-control form-control-user" id="exampleFirstName" placeholder="Nome Completo" value="<?php echo $name ?>" required>
                </div>
                <div class="form-group">
                    <?php
                    $telefone = "";
                    if (isset($valorForm['telefone'])) {
                        $telefone = $valorForm['telefone'];
                    }
                    ?>
                    <input type="text" name="telefone" id="telefone" class="form-control form-control-user" id="exampleFirstTelefone" placeholder="Contacto" value="<?php echo $telefone ?>" required>
                </div>
                <div class="form-group">
                    <?php
                    $email = "";
                    if (isset($valorForm['email'])) {
                        $email = $valorForm['email'];
                    }
                    ?>
                    <input type="email" name="email" id="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email" value="<?php echo $email ?>" required>
                </div>
                <div class="form-group">
                    <?php
                    $password = "";
                    if (isset($valorForm['password'])) {
                        $password = $valorForm['password'];
                    }
                    ?>
                    <input type="password" name="password" id="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Senha" value="<?php echo $password ?>" required>
                </div>
                <button type="submit" name="SendNewUser" value="Registar">Registar</button>
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