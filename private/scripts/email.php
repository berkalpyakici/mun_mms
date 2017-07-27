<?
function sendemail($subject, $body, $altbody, $address, $name) {

  global $config;

  $mail = new PHPMailer;

  $mail->SMTPDebug = 2;

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = $config['smtp']['host'];  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = $config['smtp']['user'];                 // SMTP username
  $mail->Password = $config['smtp']['pass'];                           // SMTP password
  $mail->Port = $config['smtp']['port'];                                    // TCP port to connect to

  $mail->setFrom($config['smtp']['from'], $config['smtp']['from_name']);
  $mail->addAddress($address, $name);

  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = $subject;
  $mail->Body    = $body;
  $mail->AltBody = $altbody;

  if(!$mail->send()) {
      return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
  } else {
      return 'ok';
  }
}

echo sendemail('Test', 'This is a test.', 'This is a test.', 'berkalp.y@gmail.com', 'Berk Alp');
