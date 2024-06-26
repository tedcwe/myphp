<?php
include 'db_config.php';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$sql = "SELECT DISTINCT name FROM attendance";
$result = $conn->query($sql);

$date = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الحضور</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>تسجيل حضور الطلاب - <?php echo $date; ?></h1>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="date" value="<?php echo $date; ?>">
            <table>
                <tr>
                    <th>اسم الطالب</th>
                    <th>حالة الحضور</th>
                    <th>صورة</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>";
                        echo "<label><input type='radio' name='attendance[" . htmlspecialchars($row['name']) . "]' value='حضر' required> حضر</label>";
                        echo "<label><input type='radio' name='attendance[" . htmlspecialchars($row['name']) . "]' value='غائب' required> غائب</label>";
                        echo "</td>";
                        echo "<td><input type='file' name='photo[" . htmlspecialchars($row['name']) . "]'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>لا يوجد طلاب مسجلين.</td></tr>";
                }
                $conn->close();
                ?>
            </table>
            <br>
            <input type="submit" value="تسجيل">
        </form>
    </div>
</body>
</html>
