<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $academic_year = $_POST['academic_year'] ?? null;
    $age = $_POST['age'] ?? null;
    $memorized_parts = $_POST['memorized_parts'] ?? null;

    if ($name && $academic_year && $age && $memorized_parts) {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        $stmt = $conn->prepare("INSERT INTO attendance (name, academic_year, age, memorized_parts) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $name, $academic_year, $age, $memorized_parts);

        if ($stmt->execute()) {
            echo "تم تسجيل الطالب بنجاح";
        } else {
            echo "خطأ: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "جميع الحقول مطلوبة";
    }
}

echo "<br><a href='register_student.php'>تسجيل طالب آخر</a>";
echo "<br><a href='index.php'>العودة إلى الصفحة الرئيسية</a>";
?>
