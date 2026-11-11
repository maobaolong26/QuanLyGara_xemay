<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM KHACH_HANG ORDER BY MaKhachHang DESC");
$customers = $stmt->fetchAll();

$editData = null;
if (isset($_GET['edit'])) {
    $stmtEdit = $pdo->prepare("SELECT * FROM KHACH_HANG WHERE MaKhachHang = ?");
    $stmtEdit->execute([$_GET['edit']]);
    $editData = $stmtEdit->fetch();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Khách Hàng - Gara Xe Máy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h3 class="text-primary text-center fw-bold mb-4">QUẢN LÝ KHÁCH HÀNG - GARA XE MÁY</h3>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 fs-6"><?= $editData ? 'Cập Nhật Khách Hàng' : 'Thêm Khách Hàng Mới' ?></h5>
                </div>
                <div class="card-body">
                    <form action="action.php" method="POST">
                        <input type="hidden" name="action" value="<?= $editData ? 'update' : 'create' ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mã Khách Hàng</label>
                            <input type="text" name="MaKhachHang" class="form-control" value="<?= $editData['MaKhachHang'] ?? '' ?>" <?= $editData ? 'readonly' : 'required' ?> placeholder="KH003">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ và Tên</label>
                            <input type="text" name="TenKhachHang" class="form-control" value="<?= $editData['TenKhachHang'] ?? '' ?>" required placeholder="Nguyễn Văn A">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số Điện Thoại</label>
                            <input type="text" name="SoDienThoai" class="form-control" value="<?= $editData['SoDienThoai'] ?? '' ?>" required placeholder="09xxxxxxxx">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa Chỉ</label>
                            <textarea name="DiaChi" class="form-control" rows="2"><?= $editData['DiaChi'] ?? '' ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100"><?= $editData ? 'Lưu Thay Đổi' : 'Thêm Mới' ?></button>
                        <?php if ($editData): ?>
                            <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Hủy</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 fs-6 fw-bold">Danh Sách Khách Hàng</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Mã KH</th>
                                <th>Họ và Tên</th>
                                <th>SĐT</th>
                                <th>Địa Chỉ</th>
                                <th class="text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $c): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($c['MaKhachHang']) ?></strong></td>
                                <td><?= htmlspecialchars($c['TenKhachHang']) ?></td>
                                <td><?= htmlspecialchars($c['SoDienThoai']) ?></td>
                                <td><?= htmlspecialchars($c['DiaChi']) ?></td>
                                <td class="text-center">
                                    <a href="index.php?edit=<?= $c['MaKhachHang'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                    <a href="action.php?action=delete&id=<?= $c['MaKhachHang'] ?>" onclick="return confirm('Xóa khách hàng này?')" class="btn btn-sm btn-danger">Xóa</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>