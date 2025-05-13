<?php
class Produk {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM produk");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $harga, $stok) {
        $stmt = $this->pdo->prepare("INSERT INTO produk (nama_produk, harga, stok) VALUES (?, ?, ?)");
        $stmt->execute([$nama, $harga, $stok]);
    }

    public function update($id, $nama, $harga, $stok) {
        $stmt = $this->pdo->prepare("UPDATE produk SET nama_produk = ?, harga = ?, stok = ? WHERE id = ?");
        $stmt->execute([$nama, $harga, $stok, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->execute([$id]);
    }
}
