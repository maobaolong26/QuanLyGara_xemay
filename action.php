<?php
require_once 'config.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// THÊM KHÁCH HÀNG
if ($action === 'create') {
    $ma = trim($_POST['MaKhachHang']);
    $ten = trim($_POST['TenKhachHang']);
    $sdt = trim($_POST['SoDienThoai']);
    $diachi = trim($_POST['DiaChi']);

    if (!empty($ma) && !empty($ten) && !empty($sdt)) {
        $stmt = $pdo->prepare("INSERT INTO KHACH_HANG (MaKhachHang, TenKhachHang, SoDienThoai, DiaChi) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ma, $ten, $sdt, $diachi]);
    }
    header('Location: index.php');
    exit;
}

// SỬA KHÁCH HÀNG
if ($action === 'update') {
    $ma = trim($_POST['MaKhachHang']);
    $ten = trim($_POST['TenKhachHang']);
    $sdt = trim($_POST['SoDienThoai']);
    $diachi = trim($_POST['DiaChi']);

    if (!empty($ma) && !empty($ten)) {
        $stmt = $pdo->prepare("UPDATE KHACH_HANG SET TenKhachHang = ?, SoDienThoai = ?, DiaChi = ? WHERE MaKhachHang = ?");
        $stmt->execute([$ten, $sdt, $diachi, $ma]);
    }
    header('Location: index.php');
    exit;
}

// xóa khách hàng
if ($action === 'delete') {
    $ma = $_GET['id'] ?? '';
    if (!empty($ma)) {
        $stmt = $pdo->prepare("DELETE FROM KHACH_HANG WHERE MaKhachHang = ?");
        $stmt->execute([$ma]);
    }
    header('Location: index.php');
    exit;
}
?>