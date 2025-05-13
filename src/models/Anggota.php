<?php
class Anggota {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM anggota");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO anggota (nama, alamat, telepon) VALUES (?, ?, ?)");
        return $stmt->execute([$data['nama'], $data['alamat'], $data['telepon']]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE anggota SET nama=?, alamat=?, telepon=? WHERE id=?");
        return $stmt->execute([$data['nama'], $data['alamat'], $data['telepon'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM anggota WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM anggota WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
