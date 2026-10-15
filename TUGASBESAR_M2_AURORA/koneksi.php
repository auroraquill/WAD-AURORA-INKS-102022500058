<?php

const DB_HOST = '127.0.0.1';
const DB_NAME = 'db_pegawai';
const DB_USER = 'root';
const DB_PASS = '';

function koneksi(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;

    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    return $pdo;
}