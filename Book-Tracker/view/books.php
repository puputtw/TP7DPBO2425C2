<?php
// Mode edit — ambil data buku berdasarkan ID jika ada parameter edit
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $book->getById($_GET['edit']);
}
?>

<section class="data-list">
  <h2>Books List</h2>

  <!-- Form Tambah / Edit Buku -->
  <div class="form-container">
    <form method="post">
      <div class="form-group">
        <label>Title:</label>
        <input type="text" name="title" value="<?= $editData['title'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label>Author:</label>
        <input type="text" name="author" value="<?= $editData['author'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label>Pages:</label>
        <input type="number" name="pages" value="<?= $editData['pages'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label>Genre:</label>
        <input type="text" name="genre" value="<?= $editData['genre'] ?? '' ?>">
      </div>

      <div class="form-group">
        <?php if (!empty($editData)): ?>
          <!-- Mode edit -->
          <input type="hidden" name="id" value="<?= $editData['book_id'] ?>">
          <button type="submit" name="update_book" class="btn-edit">Update</button>
          <a href="?page=books" class="btn-cancel">Cancel</a>
        <?php else: ?>
          <!-- Mode tambah -->
          <button type="submit" name="add_book" class="btn-add">Add Book</button>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <!-- Tabel Daftar Buku -->
  <table>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Author</th>
      <th>Pages</th>
      <th>Genre</th>
      <th>Action</th>
    </tr>

    <?php
      $books = $book->getAll();
      if (!empty($books)):
        foreach ($books as $b):
    ?>
    <tr>
      <td><?= $b['book_id'] ?></td>
      <td><?= htmlspecialchars($b['title']) ?></td>
      <td><?= htmlspecialchars($b['author']) ?></td>
      <td><?= $b['pages'] ?></td>
      <td><?= htmlspecialchars($b['genre']) ?></td>
      <td class="action-buttons-cell">
        <a href="?page=books&edit=<?= $b['book_id'] ?>" class="btn-edit">Edit</a>
        <a href="?page=books&delete_book=<?= $b['book_id'] ?>" onclick="return confirm('Delete this book?')" class="btn-delete">Delete</a>
      </td>
    </tr>
    <?php
        endforeach;
      else:
    ?>
      <tr>
        <td colspan="6" style="text-align:center;">No books found.</td>
      </tr>
    <?php endif; ?>
  </table>
</section>
