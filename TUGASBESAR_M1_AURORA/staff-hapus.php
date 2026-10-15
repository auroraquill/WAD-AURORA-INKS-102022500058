<?php
require __DIR__ . '/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = koneksi()->prepare('DELETE FROM pegawai WHERE id = ?');
    $stmt->execute([(int)($_POST['id'] ?? 0)]);
}
header('Location: staff-list.php');
exit;