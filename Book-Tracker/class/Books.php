<?php
require_once 'config/db.php';

class Books {
    private $conn;
    private $table = "books";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }
   

    // create
   public function addBook($title, $author, $pages, $genre) {
    $stmt = $this->conn->prepare("INSERT INTO {$this->table} (title, author, pages, genre)
                                  VALUES (:title, :author, :pages, :genre)");
    return $stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':pages' => $pages,
        ':genre' => $genre
    ]);
}

    // ambil semua data ari buku
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT *FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // mengambil satu data buku berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT *FROM {$this->table} WHERE book_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);


    }

public function updateBook($id, $title, $author, $pages, $genre) {
    $stmt = $this->conn->prepare("UPDATE {$this->table}
                                  SET title = :title, author = :author, pages = :pages, genre = :genre
                                  WHERE book_id = :id");
    return $stmt->execute([
        'id' => $id,
        'title' => $title,
        'author' => $author,
        'pages' => $pages,
        'genre' => $genre
    ]);
}


    //delete
     public function deleteBook($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE book_id = :id");
        return $stmt->execute(['id' => $id]);
    }

  
}
?>


