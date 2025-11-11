<?php
require_once 'config/db.php';

class Member {
    private $conn;
    private $table = "members";


    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    // Create
   public function addMember($name, $email) {
    try {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (name, email)
                                      VALUES (:name, :email)");
        return $stmt->execute([':name' => $name, ':email' => $email]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "<script>alert('Email sudah digunakan, masukkan email lain!');</script>";
        } else {
            echo "<script>alert('Terjadi error: {$e->getMessage()}');</script>";
        }
        return false;
    }
}


      // READ (ALL): Ambil semua member
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (ONE): Ambil member berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE member_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function updateMember($id, $name, $email) {
    $stmt = $this->conn->prepare("UPDATE {$this->table} 
                                  SET name=:name, email=:email 
                                  WHERE member_id=:id");
    return $stmt->execute([
        'id' => $id,
        'name' => $name,
        'email' => $email
    ]);
}

    // DELETE: Hapus member berdasarkan ID
    public function deleteMember($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE member_id = :id");
        return $stmt->execute(['id' => $id]);
    }

    
}
?>