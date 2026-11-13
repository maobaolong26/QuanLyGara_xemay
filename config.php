<?php
// Tự động kiểm tra xem web đang chạy ở máy cá nhân hay trên Hosting
$isLocal = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1');

if ($isLocal) {
    // 1. Giữ nguyên thông số chạy ở máy Local (Laragon)
    $host     = 'localhost';
    $dbname   = 'qlgara_db';
    $username = 'root';
    $password = '';
} else {
    // 2. SỬA 4 DÒNG NÀY BẰNG THÔNG SỐ LẤY Ở BƯỚC 1 TRÊN INFINITYFREE
    $host     = 'sql204.infinityfree.com';   // Dán MySQL Hostname vào đây
    $dbname   = 'if0_43433752_Gara_db';     // Dán Database Name vào đây
    $username = 'if0_43433752';            // Dán MySQL Username vào đây
    $password = 'Maolong2604';     // Dán MySQL Password vào đây
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}
?>