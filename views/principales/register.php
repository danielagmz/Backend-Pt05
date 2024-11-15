<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('views/global/estilos.php') ?>
    <link rel="stylesheet" href="public\styles\anonimo.css">
    <title>Logar-se</title>
</head>

<body>
    <div class="container">
    <?php $accion = 'Logar-se'; $url = 'login'; include('views/global/nav-anonimo.php') ?>
        <main class="content">
            <div class="content__title">Enregistrar-se</div>
            <div class="content__body content__body--40W">
                <form class="form article" action="index.php?action=register" method="POST">
                    <div class="form__group">
                        <label class="form__label" for="username">Nom d'usuari</label>
                        <input class="form__input" value="<?= isset($username) ? $username : '' ?>" placeholder="patato123" type="text" name="username" id="username" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="email">email</label>
                        <input class="form__input" value="<?= isset($email) ? $email : '' ?>" placeholder="patato123@correo.com" type="email" name="email" id="email" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="password">Contrasenya</label>
                        <input class="form__input" value="<?= isset($password) ? $password : '' ?>" placeholder="••••••••" type="password" name="password" id="password" required />
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="verifypassword">Confirma la contrasenya</label>
                        <input class="form__input" placeholder="••••••••" type="password" name="verifypassword" id="verifypassword" required />
                    </div>
                    <?= isset($response) ? $response : ''   ?>
                    <div class="form__group">
                        <input class="form__button form__button--mark" type="submit" value="Engistrar-se" />
                    </div>
                    
                </form>
            </div>
        </main>
    </div>
</body>

</html>