<?php
require_once 'config/db.php';

class StatusReading {
    private $conn;
    private $table = "reading_status";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    // CREATE: Tambah status bacaan untuk satu member dan buku tertentu
    public function addStatus($member_id, $book_id, $status, $start_date, $finish_date, $rating, $note) {
        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table} 
            (member_id, book_id, status, start_date, finish_date, rating, note)
            VALUES (:member_id, :book_id, :status, :start_date, :finish_date, :rating, :note)
        ");
        return $stmt->execute([
            'member_id' => $member_id,
            'book_id' => $book_id,
            'status' => $status,
            'start_date' => $start_date,
            'finish_date' => $finish_date,
            'rating' => $rating,
            'note' => $note
        ]);
    }

    // READ (ALL): Ambil semua data reading status (join dengan tabel member & book)
    public function getAll() {
        $stmt = $this->conn->prepare("
            SELECT rs.*, m.name AS member_name, b.title AS book_title
            FROM {$this->table} rs
            JOIN members m ON rs.member_id = m.member_id
            JOIN books b ON rs.book_id = b.book_id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read(one), ambil satu data id
    public function getById($status_id) {
        $stmt = $this->conn->prepare("
            SELECT rs.*, m.name AS member_name, b.title AS book_title
            FROM {$this->table} rs
            JOIN members m ON rs.member_id = m.member_id
            JOIN books b ON rs.book_id = b.book_id
            WHERE rs.status_id = :status_id
        ");
        $stmt->execute(['status_id' => $status_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
 // UPDATE: ubah data status bacaan
public function updateStatus($status_id, $member_id, $book_id, $status, $start_date, $finish_date, $rating, $note) {
    $stmt = $this->conn->prepare("UPDATE {$this->table}
        SET member_id = :member_id,
            book_id = :book_id,
            status = :status,
            start_date = :start_date,
            finish_date = :finish_date,
            rating = :rating,
            note = :note
        WHERE status_id = :status_id
    ");
    return $stmt->execute([
        'status_id' => $status_id,
        'member_id' => $member_id,
        'book_id' => $book_id,
        'status' => $status,
        'start_date' => $start_date,
        'finish_date' => $finish_date,
        'rating' => $rating,
        'note' => $note
    ]);
}

    // DELETE: Hapus data status bacaan berdasarkan ID
    public function deleteStatus($status_id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE status_id = :id");
        return $stmt->execute(['id' => $status_id]);
    }


    // READ (BY MEMBER): Ambil semua buku yang dibaca oleh satu member
    public function getByMember($member_id) {
        $stmt = $this->conn->prepare("
            SELECT rs.*, b.title, b.author
            FROM {$this->table} rs
            JOIN books b ON rs.book_id = b.book_id
            WHERE rs.member_id = :member_id
        ");
        $stmt->execute(['member_id' => $member_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>