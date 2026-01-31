<?php

session_start();
require('../conect/countect.php');

function test_input($date){
    $date=htmlspecialchars($date);
    $date=trim($date);
    $date=stripslashes($date);
   return $date;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name =test_input( $_POST['name']);
  $email = test_input($_POST['email']);
  $phone =test_input( $_POST['phone']);
  $service =test_input($_POST['service']);
  $message = test_input($_POST['message']);

  $to = "mhmdalqhwm27@gmail.com";
  $subject = "رسالة جديدة من نموذج الاتصال";
  $body = "الاسم: $name\nالبريد: $email\nالهاتف: $phone\nالخدمة: $service\nالرسالة:\n$message";
  $headers = "From: $email";
//mailترسل البريد
  if (mail($to, $subject, $body, $headers)) {
    echo "تم الإرسال";
  } else {
    echo "فشل الإرسال";
  }
}



?>
