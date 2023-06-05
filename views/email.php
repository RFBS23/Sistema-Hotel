<?php
  use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
  require '../assets/PHPMailer/src/Exception.php';
  require '../assets/PHPMailer/src/PHPMailer.php';
  require '../assets/PHPMailer/src/SMTP.php';
  $mail = new PHPMailer(true);

  try{
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rodrigobarriossaavedra19@gmail.com';
    $mail->Password   = 'zvodmflxidyelkbp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    //Recipients
    $mail->setFrom('rodrigobarriossaavedra19@gmail.com', 'FABRIDEV');
    $mail->addAddress('fabriziobarrios22@gmail.com', 'RFBS');//Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Alerta de seguridad';
    $mail->Body = '<img src="../images/logo1.png" alt="logo">
      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h1 class="card-title pricing-card-title">Detectamos un nuevo acceso a tu Cuenta de Google en el dispositivo Windows</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Si fuiste tú, no tienes que hacer nada</li>
              <li>De lo contrario, te ayudaremos a proteger tu cuenta.</li>
              <li>piensa pe mascota</li>
            </ul>
          </div>
        </div>
      </div>';
    $mail->send();
    //echo "correo enviado";

    /*
    $cuerpo= '<h4>mensaje de prueba</h4>';
    $cuerpo .= '<p>Detectamos un nuevo acceso a tu Cuenta de Google en el dispositivo Windows. Si fuiste tú, no tienes que hacer nada. De lo contrario, te ayudaremos a proteger tu cuenta.</p>';

    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = 'le enviamos los detalles de su compra.';

    $mail->setLanguage('es', '../assets/PHPMailer/language/phpmailer.lang-es.php');
    
    $mail->send();*/
  } catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
    exit;
    
  }

?>