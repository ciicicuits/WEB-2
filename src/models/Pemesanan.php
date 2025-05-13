<?php
class Pemesanan {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM pemesanan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithProduk() {
        $stmt = $this->pdo->query("
            SELECT p.id, p.id_anggota, p.id_produk, p.jumlah, p.tanggal,
                   a.nama AS nama_anggota,
                   pr.nama_produk, pr.harga
            FROM pemesanan p
            JOIN anggota a ON p.id_anggota = a.id
            JOIN produk pr ON p.id_produk = pr.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO pemesanan (id_anggota, id_produk, jumlah, tanggal)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['id_anggota'],
            $data['id_produk'],
            $data['jumlah'],
            $data['tanggal']
        ]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pemesanan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE pemesanan SET id_anggota = ?, id_produk = ?, jumlah = ?, tanggal = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['id_anggota'],
            $data['id_produk'],
            $data['jumlah'],
            $data['tanggal'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM pemesanan WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
