<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/869dc8f5ef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stylelogin.css" />
    <title>login CSS</title>
    
</head>

<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="validacion.php" method="POST">
            <h1>Crea tu Cuenta</h1>
            <div class="social-container">
                <a href="https://www.facebook.com/" class="social">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://accounts.google.com/v3/signin/identifier?dsh=S1074560095%3A1682098576438004&continue=https%3A%2F%2Fwww.google.com%3Fhl%3Des&ec=GAlA8wE&hl=es&flowName=GlifWebSignIn&flowEntry=AddSession" class="social">
                    <i class="fab fa-google" id="red"></i>
                </a>
                <a href="https://www.linkedin.com/home" class="social">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <span>o usa tu email como registro</span>
            <input type="text" name="Nombre" id="Nombre" placeholder="Name" />
            <input type="email" name="Email" id="Email" placeholder="Email" />
            <input type="password" name="Clave" id="Clave" placeholder="Password" />
            <button type="submit" name="registro" id="lila">Registrar</button>
            <div class="logo-container">
                <img src="images/Logo.jpeg" alt="logo" class="logo">
            </div>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="validacion.php" method="POST">
            <h1>Iniciar Sesión</h1>
            <div class="social-container">
                <a href="https://www.facebook.com/" class="social">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://accounts.google.com/v3/signin/identifier?dsh=S1074560095%3A1682098576438004&continue=https%3A%2F%2Fwww.google.com%3Fhl%3Des&ec=GAlA8wE&hl=es&flowName=GlifWebSignIn&flowEntry=AddSession" class="social">
                    <i class="fab fa-google" id="red"></i>
                </a>
                <a href="https://www.linkedin.com/home" class="social">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <span>o usa tu email</span>
            <div>
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="Email" name="Email" placeholder="correo" required>
            </div>
            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="Clave" name="Clave" placeholder="contraseña" required>
            </div>
            <button type="submit" name="login">Iniciar sesión</button>
            <br>
            <a href="restablecer.php">Olvidaste tu contraseña?</a>
            <div class="logo-container">
                <img src="images/Logo.jpeg" alt="logo" class="logo">
            </div>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>¡Bienvenido!</h1>
                <p>Inicia sesión con tu cuenta</p>
                <button class="ghost" id="signIn">Inicia sesión</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hola!!!</h1>
                <p>Crear tu cuenta</p>
                <button class="ghost" id="signUp">Registrar</button>
            </div>
        </div>
        
    </div>
</div>

<script src="js/app.js"></script>
</body>
</html>
