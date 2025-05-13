<?php
class Transaksi {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM transaksi");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO transaksi (id_anggota, tanggal, jumlah) VALUES (?, ?, ?)");
        return $stmt->execute([$data['id_anggota'], $data['tanggal'], $data['jumlah']]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE transaksi SET id_anggota=?, tanggal=?, jumlah=? WHERE id=?");
        return $stmt->execute([$data['id_anggota'], $data['tanggal'], $data['jumlah'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM transaksi WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM transaksi WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
