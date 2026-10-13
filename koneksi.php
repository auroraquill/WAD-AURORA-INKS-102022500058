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

function ambilPegawai(): array {
    return koneksi()->query('SELECT id, nama, jabatan, kontak FROM pegawai ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
}

function ambilSatu(int $id): ?array {
    $stmt = koneksi()->prepare('SELECT id, nama, jabatan, kontak FROM pegawai WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function tambahPegawai(string $nama, string $jabatan, string $kontak): void {
    $stmt = koneksi()->prepare('INSERT INTO pegawai (nama, jabatan, kontak) VALUES (?, ?, ?)');
    $stmt->execute([$nama, $jabatan, $kontak]);
}

function ubahPegawai(int $id, string $nama, string $jabatan, string $kontak): void {
    $stmt = koneksi()->prepare('UPDATE pegawai SET nama = ?, jabatan = ?, kontak = ? WHERE id = ?');
    $stmt->execute([$nama, $jabatan, $kontak, $id]);
}

function hapusPegawai(int $id): void {
    $stmt = koneksi()->prepare('DELETE FROM pegawai WHERE id = ?');
    $stmt->execute([$id]);
}