<?php
session_start();
include('./conect/counect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'])) {
    $project_id = intval($_POST['project_id']);

    // جلب مسار الصورة أولاً لحذفها من المجلد
    $query = "SELECT img_project FROM add_project WHERE id = $project_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && file_exists($row['img_project'])) {
        unlink($row['img_project']); // حذف الصورة من السيرفر
    }

    // حذف المشروع من قاعدة البيانات
    $delete_query = "DELETE FROM add_project WHERE id = $project_id";
    mysqli_query($conn, $delete_query);
   
}

header("Location: admin_projects.php");
exit;

?>