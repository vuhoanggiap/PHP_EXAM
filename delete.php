<?php
include 'config.php';

// Lấy id truyền từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Nếu id hợp lệ
if ($id > 0) {
    $sql = "DELETE FROM item_sale WHERE id = $id";
    $conn->query($sql);
}

// Quay lại trang danh sách sau khi xóa
header("Location: index.php");
exit;
?>
