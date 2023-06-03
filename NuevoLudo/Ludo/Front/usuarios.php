<?php
// Iniciar la sesión
session_start();

// Verificar las credenciales del usuario
if (/* Las credenciales son correctas */) {
  // Guardar el ID del usuario en una variable de sesión
  $_SESSION['id_usuario'] = $id_usuario;

  // Obtener el nombre y el email del usuario desde la base de datos
  // Supongamos que tienes las variables $nombre y $email con los valores correspondientes

  // Guardar el nombre y el email en las variables de sesión
  $_SESSION['nombre'] = $nombre;
  $_SESSION['email'] = $email;

  // Redirigir al usuario a la página de perfil
  header("Location: perfil.php");
  exit();
}
?>
