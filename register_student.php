<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل طالب جديد</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>تسجيل طالب جديد</h1>
        <form action="register_student_process.php" method="post">
            <label for="name">اسم الطالب:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="academic_year">السنه الدراسيه:</label>
            <input type="text" id="academic_year" name="academic_year" required><br><br>
            
            <label for="age">السن:</label>
            <input type="number" id="age" name="age" required><br><br>
            
            <label for="memorized_parts">عدد اجزاء الحفظ:</label>
            <input type="number" id="memorized_parts" name="memorized_parts" required><br><br>
            
            <input type="submit" value="تسجيل">
        </form>
        <br>
        <a href="index.php">العودة إلى الصفحة الرئيسية</a>
    </div>
</body>
</html>