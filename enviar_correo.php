<?php
// Incluye las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere PHPMailer
require 'PHPMailer/Exception.php';   // Ruta a Exception.php
require 'PHPMailer/PHPMailer.php';    // Ruta a PHPMailer.php
require 'PHPMailer/SMTP.php';         // Ruta a SMTP.php

// Verifica si el formulario fue enviado
if (isset($_POST['submit'])) {
    // Obtiene los datos del formulario
    $nombre = $_POST['InputName'];
    $dni = $_POST['InputDni'];
    $celular = $_POST['InputCelular'];
    $mensaje = $_POST['InputMessage'];

    // Crea una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configura SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = '@gmail.com';  // Tu correo de Gmail
        $mail->Password = '';  // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('tucorreo@gmail.com', 'Tu Nombre');
        $mail->addAddress('destinatario@ejemplo.com', 'Nombre Destinatario');  // Correo al que se envía

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body    = "Nombre: $nombre <br> DNI: $dni <br> Celular: $celular <br> Mensaje: $mensaje";

        // Enviar el correo
        $mail->send();
        // Redirige a la página de inicio después de enviar el correo
        header("Location: index.html"); // O cualquier otra página que desees redirigir
        exit;  // Asegúrate de llamar a exit después de header() para detener la ejecución de PHP
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
