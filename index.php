<?php
include 'config.php';
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

<div class="title-table">Sale Items</div>
<a href="add.php" class="btn-add">Add New</a>

<table>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Ngày hết hạn</th>
        <th>Ghi chú</th>
        <th>Hành động</th>
    </tr>

<?php
$sql = "SELECT * FROM item_sale ORDER BY id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['item_code']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['expired_date']; ?></td>
            <td><?php echo $row['note']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="icon-edit">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="icon-delete"
                   onclick="return confirm('Bạn có chắc muốn xóa?');">
                   Delete
                </a>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='7'>Chưa có sản phẩm nào</td></tr>";
}
?>

</table>

<footer>Số 8, Tôn Thất Thuyết, Cầu Giấy, Hà Nội</footer>

</body>
</html>
