<?php
require __DIR__ . '/data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    hapusPegawai((int)($_POST['id'] ?? 0));
}
header('Location: staff-list.php');
exit;