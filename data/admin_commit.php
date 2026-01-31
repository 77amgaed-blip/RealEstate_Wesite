<?php
session_start();
require('./conect/countect.php');

// الموافقة على تعليق
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_id'])) {
    $id = (int)$_POST['approve_id'];
    $stmt = mysqli_prepare($mysqli, "UPDATE comments SET approved = 1 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: admin_comments.php");
    exit;
}

// جلب جميع التعليقات
$res = mysqli_query($mysqli, "SELECT * FROM comments ORDER BY created_at DESC");
$comments = [];
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $comments[] = $row;
    }
    mysqli_free_result($res);
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم التعليقات | BS_BIM</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background:#f8fafc; margin:0; padding:0; }
        .container { max-width: 1000px; margin: 2rem auto; background:#fff; padding:2rem; border-radius:12px; box-shadow:0 0 20px rgba(0,0,0,0.05); }
        h1 { font-size:2rem; margin-bottom:1rem; color:#1e293b; }
        table { width:100%; border-collapse:collapse; margin-top:1rem; }
        th, td { padding:1rem; border-bottom:1px solid #e2e8f0; text-align:right; }
        th { background:#f1f5f9; color:#334155; }
        tr:nth-child(even) { background:#f9fafb; }
        .btn { padding:.5rem 1rem; border:none; border-radius:6px; cursor:pointer; font-weight:600; }
        .approve { background:#10b981; color:#fff; }
        .approved-label { color:#10b981; font-weight:bold; }
        .pending-label { color:#f59e0b; font-weight:bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>لوحة تحكم التعليقات - BS_BIM</h1>
        <table>
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>التقييم</th>
                    <th>التعليق</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['name']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= str_repeat('★', $c['rating']) . str_repeat('☆', 5 - $c['rating']) ?></td>
                        <td><?= nl2br(htmlspecialchars($c['comment'])) ?></td>
                        <td>
                            <?= $c['approved'] ? '<span class="approved-label">تمت الموافقة</span>' : '<span class="pending-label">قيد المراجعة</span>' ?>
                        </td>
                        <td>
                            <?php if (!$c['approved']): ?>
                                <form method="post" style="margin:0;">
                                    <input type="hidden" name="approve_id" value="<?= $c['id'] ?>">
                                    <button type="submit" class="btn approve">الموافقة</button>
                                </form>
                            <?php else: ?>
                                <span style="color:#94a3b8;">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($comments)): ?>
                    <tr><td colspan="6" style="text-align:center;">لا توجد تعليقات بعد.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
