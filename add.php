<?php
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST["item_code"];
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $expired_date = $_POST["expired_date"];
    $note = $_POST["note"];

    // Validate dữ liệu
    if (empty($item_code) || empty($item_name)) {
        $error = "Item code và item name không được để trống!";
    } elseif (!ctype_alnum($item_code) || !ctype_alnum(str_replace(' ', '', $item_name))) {
        $error = "Không được chứa ký tự đặc biệt!";
    } else {
        $sql = "INSERT INTO item_sale (item_code, item_name, quantity, expired_date, note)
                VALUES ('$item_code', '$item_name', '$quantity', '$expired_date', '$note')";
        $conn->query($sql);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Thêm sản phẩm mới</title>
</head>
<body>

<header>
    <h1>V_Store</h1><span>Items</span>
</header>

<div class="form-container">
    <h2>Thêm sản phẩm mới</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Mã sản phẩm:</label>
        <input type="text" name="item_code">

        <label>Tên sản phẩm:</label>
        <input type="text" name="item_name">

        <label>Số lượng:</label>
        <input type="number" step="0.01" name="quantity">

        <label>Ngày hết hạn:</label>
        <input type="date" name="expired_date">

        <label>Ghi chú:</label>
        <input type="text" name="note">

        <button type="submit">Thêm mới</button>
    </form>

    <br>
    <a href="index.php" class="btn-add">⟵ Quay lại danh sách</a>
</div>

<footer>Số 8, Tôn Thất Thuyết, Cầu Giấy, Hà Nội</footer>

</body>
</html>
