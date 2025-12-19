<?php
// Kết nối Database InfinityFree
$host = 'sql103.infinityfree.com'; 
$dbname = 'if0_40716215_db_ttsv';   
$username = 'if0_40716215';         
$password = 'Thmnm1234';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch(PDOException $e) { echo "Lỗi: " . $e->getMessage(); }

// Xử lý thêm nhân viên
if (isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $position = $_POST['position'];
    if (!empty($fullname) && !empty($position)) {
        $sql = "INSERT INTO employees (fullname, position) VALUES (?, ?)";
        $conn->prepare($sql)->execute([$fullname, $position]);
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Nhân Viên</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">    
            <h1>PM1_Cuối kì_Nguyễn Thành Thuận</h1>
        </div>

        <form method="POST" class="add-form">
            <input type="text" name="fullname" placeholder="Nhập tên nhân viên..." required>
            <input type="text" name="position" placeholder="Chức vụ (VD: Kế toán, IT...)" required>
            <button type="submit" name="add">➕ Thêm Nhân Viên</button>
        </form>

        <div class="list-section">
            <h3>📋 Danh sách nhân viên chi tiết</h3>
            <table>
                <thead>
                    <tr>
                        <th>Họ và Tên</th>
                        <th>Chức vụ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->query("SELECT * FROM employees ORDER BY id DESC");
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                            <td><strong>{$row['fullname']}</strong></td>
                            <td>{$row['position']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn-edit'>✎ Sửa</a>
                                <a href='delete.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Xóa nhân viên này?\")'>🗑 Xóa</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>