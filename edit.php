<?php
include 'config.php';

// Lấy id từ URL
$id = $_GET['id'] ?? null;

// Nếu không có id → quay về danh sách
if (!$id) {
    header("Location: index.php");
    exit;
}

// Lấy dữ liệu sản phẩm
$sql = "SELECT * FROM item_sale WHERE id = $id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();

if (!$item) {
    echo "Không tìm thấy sản phẩm!";
    exit;
}

$error = "";

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST["item_code"];
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $expired_date = $_POST["expired_date"];
    $note = $_POST["note"];

    // Validate
    if (empty($item_code) || empty($item_name)) {
        $error = "Item code và item name không được để trống!";
    } elseif (!ctype_alnum($item_code) || !ctype_alnum(str_replace(' ', '', $item_name))) {
        $error = "Không được chứa ký tự đặc biệt!";
    } else {
        // Update dữ liệu
        $sqlUpdate = "UPDATE item_sale 
                      SET item_code='$item_code', item_name='$item_name', quantity='$quantity', expired_date='$expired_date', note='$note'
                      WHERE id = $id";
        if ($conn->query($sqlUpdate) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Lỗi cập nhật: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>V_Store</h1><span>Items</span>
</header>
<div class="form-container">
    <h2>Sửa sản phẩm</h2>
    <form method="post" action="">
        <label>Mã sản phẩm:</label>
        <input type="text" name="item_code" value="<?php echo $item['item_code']; ?>">

        <label>Tên sản phẩm:</label>
        <input type="text" name="item_name" value="<?php echo $item['item_name']; ?>">

        <label>Số lượng:</label>
        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>">

        <label>Ngày hết hạn:</label>
        <input type="date" name="expired_date" value="<?php echo $item['expired_date']; ?>">

        <label>Ghi chú:</label>
        <input type="text" name="note" value="<?php echo $item['note']; ?>">

        <button type="submit">Lưu thay đổi</button>
    </form>
    <a href="index.php" class="btn-add">← Quay lại danh sách</a>
</div>
<footer>Số 8, Tôn Thất Thuyết, Cầu Giấy, Hà Nội</footer>

</body>
</html>
