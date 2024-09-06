<?php
require_once 'Database.php';

class Pegawai {
    private $conn;
    private $table_name = "pegawai";

    public $id;
    public $nama;
    public $jabatan;
    public $tanggal_bergabung;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama, jabatan, tanggal_bergabung) VALUES (:nama, :jabatan, :tanggal_bergabung)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':jabatan', $this->jabatan);
        $stmt->bindParam(':tanggal_bergabung', $this->tanggal_bergabung);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama = :nama, jabatan = :jabatan, tanggal_bergabung = :tanggal_bergabung WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':jabatan', $this->jabatan);
        $stmt->bindParam(':tanggal_bergabung', $this->tanggal_bergabung);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>