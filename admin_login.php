
<?php
 
 session_start();

include('./conect/counect.php');


// إعدادات المدير (يجب تغييرها في الإنتاج)
//$admin_username = 'admin';
//$admin_password = 'bs_bim_2025'; // يُنصح بتشفيرها

$error_message = '';
$_message = '';
function test_input($data){
    $date=trim($data);
	$date=stripslashes($data);
	$date=htmlspecialchars($date);
	return $data;
	}
		
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_username = test_input($_POST['username']  );
    $admin_password = test_input($_POST['password'] );
 
    $add= test_input($_POST['add']);
}
    if(isset($add)){
     if(empty($admin_username) || empty($admin_password)){
        $error_message ="الرجاء ادخال الباسورد ولإسم ";
     }
     else{
      $query="SELECT  *FROM login WHERE username='$admin_username' AND password ='$admin_password'";
      
      $result=mysqli_query($conn , $query);
      
      if(mysqli_num_rows($result) == 1){
        $_SESSION['username'] = $admin_username;

        $_message = 'مرحبا بك ايها المدير سيتم تحويلك إلى لوحة التحكم';
        header("REFRESH:2 ; URL=admin_projects.php");//دالة نحدد فيها الوقت الذي سيستغرقه للإنتقال الى لوحة التحكم
      //خلال ثانيتين refre
      }
      else
        {
            $error_message = 'اسم المستخدم أو كلمة المرور غير صحيحة';
            header("REFRESH:2 ; URL=index.php");
        }
         }

        }


                   

    
//     if ($username === $admin_username && $password === $admin_password) {
//         $_SESSION['admin_logged_in'] = true;
//         $_SESSION['admin_username'] = $username;
//         header('Location: admin_projects.php');
//         exit;
//     } else {
//         $error_message = 'اسم المستخدم أو كلمة المرور غير صحيحة';
//     }
// }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول  - BS_BIM</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        
        .login-header {
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: right;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #3498db;
        }
        
        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .error-message {
            background: #e74c3c;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .message {
            background:green;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .back-link {
            margin-top: 20px;
        }
        
        .back-link a {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-shield-alt"></i> تسجيل دخول </h2>
            <p>لوحة تحكم إدارة المشاريع</p>
        </div>
        
     
            
        <?php if ($error_message): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <?php if($_message):?>
                 <div class="message">
                <i class="fas fa-exclamation-triangl"></i> <?php echo $_message; ?>
                </div> 
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?> ">
            <div class="form-group">
                <label for="username">اسم المستخدم:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">كلمة المرور:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="login-btn" name="add">
                <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
            </button>
        </form>
        
        <div class="back-link">
            <a href="index.php">
                <i class="fas fa-arrow-right"></i> العودة إلى الموقع الرئيسي
            </a>
        </div>
    </div>
</body>
</html>

