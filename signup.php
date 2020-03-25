<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users(email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario Creado con Éxito';
    } else {
      $message = 'Lo siento, hubo un Error registrando el usuario';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Regístrate</h1>
    <span>ó <a href="login.php">Inicia Sesión</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Escribe tu Correo">
      <input name="password" type="password" placeholder="Escribe tu Contraseña">
      <input name="confirm_password" type="password" placeholder="Confirma tu Contraseña">
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>
