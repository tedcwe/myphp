<?php
include 'db_config.php';

$date = $_POST['date'] ?? null;
$attendance = $_POST['attendance'] ?? null;
$photos = $_FILES['photo'] ?? null;

if ($date && $attendance) {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");

    $stmt = $conn->prepare("INSERT INTO attendance (name, date, status, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $date, $status, $photo);

    foreach ($attendance as $name => $status) {
        $name = $conn->real_escape_string($name);
        $status = $conn->real_escape_string($status);

        // Handle file upload
        if (isset($photos['name'][$name]) && $photos['name'][$name]) {
            $target_dir = "uploads/";
            $file_name = basename($photos['name'][$name]);
            $file_tmp = $photos['tmp_name'][$name];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $photo = $target_dir . uniqid() . '.' . $file_ext;

            // Ensure the uploads directory exists
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            move_uploaded_file($file_tmp, $photo);
        } else {
            $photo = null; // No photo uploaded
        }

        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo "تم تسجيل الحضور بنجاح";
} else {
    echo "خطأ: لم يتم إرسال بيانات الحضور بشكل صحيح.";
}

echo "<br><a href='index.php'>العودة إلى الصفحة الرئيسية</a>";
?>
