<!-- 
<?php

session_start();

// الاتصال بقاعدة البيانات
if (!include('conect/counect.php')) {
    header('Content-Type: text/plain; charset=UTF-8');//يعني أننا نخبر المتصفح كيف يتعامل مع الرد القادم من الخادم
    echo 'خطأ: فشل الاتصال بقاعدة البيانات.';
    exit;
}

// التحقق من طريقة الطلب
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $rating  = (int)($_POST['rating'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');

    // التحقق من صحة البيانات
    $errors = [];
    if (mb_strlen($name) < 3) $errors[] = 'الاسم لا يقل عن 3 أحرف.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'البريد الإلكتروني غير صالح.';
    if ($rating < 1 || $rating > 5) $errors[] = 'التقييم يجب أن يكون بين 1 و 5.';
    if (mb_strlen($comment) < 10) $errors[] = 'التعليق لا يقل عن 10 أحرف.';

    header('Content-Type: text/plain; charset=UTF-8');

    if (!empty($errors)) {
        echo 'خطأ: ' . implode('، ', $errors);
        exit;
    }

    // إدخال البيانات في قاعدة البيانات
    $approved = 1; // اجعل التعليق يظهر مباشرة
    $sql = "INSERT INTO comments (name, email, rating, comment, approved, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo 'خطأ: فشل تجهيز الاستعلام.';
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'ssisi', $name, $email, $rating, $comment, $approved);

    if (!mysqli_stmt_execute($stmt)) {
        echo 'خطأ: فشل تنفيذ الإدخال.';
        mysqli_stmt_close($stmt);
        exit;
    }

    mysqli_stmt_close($stmt);

    // الرد النصي المتوقع من JavaScript
    echo 'تم إرسال التعليق بنجاح.';
    exit;
}

// إذا لم يكن الطلب POST
header('Content-Type: text/plain; charset=UTF-8');
echo 'خطأ: طلب غير صالح.';



 ?>
 




 
 -->
