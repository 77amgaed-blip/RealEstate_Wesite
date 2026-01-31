<?php
session_start();
include('./conect/counect.php');

if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

// إنشاء مجلد البيانات إذا لم يكن موجوداً
if (!file_exists('data')) {
    mkdir('data', 0755, true);
}

// توليد توكن جديد عند تحميل النموذج فقط
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['current_insert_token'] = md5(uniqid());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['insert_token'] !== $_SESSION['last_insert_token']) {

        $project_name = $_POST['project_name'];
        $desc_project = $_POST['desc_project'];
        $category_project = $_POST['category_project'];
        $img_project = $_FILES['img_project'];

        $image_temp = $img_project['tmp_name'];
        $image_size = $img_project['size'];
        $allowed_extensions = ['jpg', 'gif', 'jpeg', 'png'];
        $max_size = 5 * 1024 * 1024;

        $image_extension = strtolower(pathinfo($img_project['name'], PATHINFO_EXTENSION));
        $errors = [];

        if ($image_size > $max_size) {
            $errors[] = '<div>حجم الملف أكبر من 5 ميجا</div>';
        }

        if (!in_array($image_extension, $allowed_extensions)) {
            $errors[] = '<div>امتداد الملف غير مسموح</div>';
        }

        if (empty($errors)) {
            $upload_dir = 'images/projects/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $new_filename = rand(0, 50000) . '.' . $image_extension;
            $new_img_path = $upload_dir . $new_filename;

            if (move_uploaded_file($image_temp, $new_img_path)) {
                $query = "INSERT INTO add_project (project_name, desc_project, category_project, img_project)
                          VALUES ('$project_name', '$desc_project', '$category_project', '$new_img_path')";

                if (mysqli_query($conn, $query)) {
                    $success_message = '<div>✅ تم إضافة المشروع بنجاح</div>';
                    $_SESSION['last_insert_token'] = $_POST['insert_token'];
                } else {
                    $success_message = '<div>❌ خطأ في إدخال البيانات</div>';
                }
            } else {
                $success_message = '<div>❌ فشل في رفع الصورة</div>';
            }


        } else {

            foreach ($errors as $error) {
                echo $error;
            }
        }

    } else {
        $success_message = "<div>⚠️ تم تنفيذ هذه العملية مسبقًا.</div>";
    }
}

?>


<?php

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'])) {
//     $project_id = intval($_POST['project_id']);

//     // جلب مسار الصورة أولاً لحذفها من المجلد
//     $query = "SELECT img_project FROM add_project WHERE id = $project_id";
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);

//     if ($row && file_exists($row['img_project'])) {
//         unlink($row['img_project']); // حذف الصورة من السيرفر
//     }
//      $success_message="<div>  تم حذف المشروع بنجاح  .</div>";
//     // حذف المشروع من قاعدة البيانات
//     $delete_query = "DELETE FROM add_project WHERE id = $project_id";
//     mysqli_query($conn, $delete_query);
//     $success_message="<div>  تم الحذف بنجاح  .</div>";
// }

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المشاريع - BS_BIM</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-header {
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        .admin-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-title h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        
        .admin-actions a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
            margin-left: 10px;
            transition: background 0.3s ease;
        }
        
        .admin-actions a:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .admin-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .add-project-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
        }
        
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        
        .submit-btn {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }
        
        .projects-list {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .projects-header {
            background: #34495e;
            color: white;
            padding: 20px;
        }
        
        .projects-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        
        .project-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .project-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f0f0f0;
        }
        
        .project-info {
            padding: 15px;
        }
        
        .project-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .project-category {
            background: #3498db;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .project-description {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 15px;
        }
        
        .project-actions {
            display: flex;
            gap: 10px;
        }
        
        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .delete-btn:hover {
            background: #c0392b;
        }
        
        .success-message {
            background: #2ecc71;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .no-projects {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .admin-header .container {
                flex-direction: column;
                gap: 15px;
            }
            
            .projects-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <div class="admin-title">
                <h1><i class="fas fa-cogs"></i> لوحة تحكم إدارة المشاريع</h1>
                <p>مرحباً <?php echo $_SESSION['username']; ?></p>
            </div>
            <div class="admin-actions">
                <a href="index.php" target="_blank">
                    <i class="fas fa-external-link-alt"></i> عرض الموقع
                </a>
                <a href="?logout=1">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </a>
            </div>
        </div>
    </div>

    <div class="admin-content">
        <?php if (isset($success_message)): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
         <div class="admin-content">
        <?php if (isset($error)): ?>

            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- نموذج إضافة مشروع جديد -->
        <div class="add-project-form">
            <h2><i class="fas fa-plus-circle"></i> إضافة مشروع جديد</h2>
            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <!-- <input type="hidden" name="action" value="add_project"> -->
                <input type="hidden" name="insert_token" value="<?php echo $current_token; ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="title">عنوان المشروع:</label>
                        <input type="text" id="title" name="project_name" required>
                    </div>
                    
                    <div class="form-group">
                         
                        <label for="category">فئة المشروع:</label>
                        <select id="category" name="category_project" required>
                           <option value="">اختر الفئة</option>
                           
                           <?php
                            $query="SELECT *FROM project_category ";
                            $result=mysqli_query($conn,$query);
                            while($row=mysqli_fetch_assoc($result)){  
                          echo '<option name="project_category">'.$row['category_name'].'</option>';
                           
                            }
                            ?>
                        </select>
                    </div>



                </div>
                
                <div class="form-group">
                    <label for="description">وصف المشروع:</label>
                    <textarea id="description" name="desc_project" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="image">صورة المشروع:</label>
                    <input type="file" id="image" name="img_project"   required>
                </div>
                
                <button type="submit" class="submit-btn" name="addproject">
                    <i class="fas fa-plus"></i> إضافة المشروع
                </button>
            </form>
        </div>
       
             <!-- قائمة المشاريع -->
        <div class="projects-list">
            <div class="projects-header">
                <h2><i class="fas fa-list"></i> المشاريع المضافة (<?php $query ="SELECT COUNT(*) AS totel FROM  add_project
                              WHERE project_name IS NOT NULL AND category_project IS NOT NULL AND  desc_project IS NOT NULL AND img_project IS NOT NULL "; 
                             $result=mysqli_query($conn ,$query);
                             $row=mysqli_fetch_assoc($result);
                            echo $row['totel'];  ?>
                            
                           )</h2>
            </div>
            

           <div class="projects-list">
    <div class="projects-header">
        <h2><i class="fas fa-list"></i> قائمة المشاريع</h2>
    </div>

    <div class="projects-grid">
        <?php
        include('./conect/counect.php');

        $query = "SELECT * FROM add_project WHERE project_name != '' AND desc_project != '' AND img_project != ''";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="project-card">';
                echo '<img src="' . $row['img_project'] . '" alt="صورة المشروع" class="project-image">';
                echo '<div class="project-info">';
                echo '<div class="project-title">' . htmlspecialchars($row['project_name']) . '</div>';
                echo '<div class="project-category">' . htmlspecialchars($row['category_project']) . '</div>';
                echo '<div class="project-description">' . nl2br(htmlspecialchars($row['desc_project'])) . '</div>';
                echo '<div class="project-actions">';
                echo '<form method="POST" action="delete_project.php" onsubmit="return confirm(\'هل أنت متأكد من حذف هذا المشروع؟\');">';
                echo '<input type="hidden" name="project_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="delete-btn">حذف</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="no-projects">لا توجد مشاريع مضافة حتى الآن.</div>';
        }
        ?>
    </div>
</div>

     
    <?php
//    معالجة تسجيل الخروج
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: admin_login.php');
        exit;
    }
    ?>
</body>
</html>

