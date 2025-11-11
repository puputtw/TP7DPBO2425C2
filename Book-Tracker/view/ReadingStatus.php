<?php
// ambil data lama jika sedang edit
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $statusReading->getById($_GET['edit']);
}
?>

<section class="data-list">
  <h2>Reading Status</h2>

  <div class="form-container">
    <form method="post">
      <input type="hidden" name="id" value="<?= $editData['status_id'] ?? '' ?>">

      <div class="form-group">
        <label>Member:</label>
        <select name="member_id" required>
          <option value="">-- Pilih Member --</option>
          <?php foreach ($member->getAll() as $m): ?>
            <option value="<?= $m['member_id'] ?>"
              <?= isset($editData['member_id']) && $editData['member_id'] == $m['member_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($m['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Book:</label>
        <select name="book_id" required>
          <option value="">-- Pilih Buku --</option>
          <?php foreach ($book->getAll() as $b): ?>
            <option value="<?= $b['book_id'] ?>"
              <?= isset($editData['book_id']) && $editData['book_id'] == $b['book_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($b['title']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Status:</label>
        <select name="status_baca" required>
          <option value="">-- Pilih Status --</option>
          <option value="Plan to Read" <?= (isset($editData['status']) && $editData['status'] === 'Plan to Read') ? 'selected' : '' ?>>Plan to Read</option>
          <option value="In Progress" <?= (isset($editData['status']) && $editData['status'] === 'In Progress') ? 'selected' : '' ?>>In Progress</option>
          <option value="Finished" <?= (isset($editData['status']) && $editData['status'] === 'Finished') ? 'selected' : '' ?>>Finished</option>
        </select>
      </div>

      <div class="form-group">
        <label>Start Date:</label>
        <input type="date" name="start_date" value="<?= $editData['start_date'] ?? '' ?>">
      </div>

      <div class="form-group">
        <label>Finish Date:</label>
        <input type="date" name="finish_date" value="<?= $editData['finish_date'] ?? '' ?>">
      </div>

      <div class="form-group">
        <label>Rating:</label>
        <input type="number" name="rating" min="1" max="5" value="<?= $editData['rating'] ?? '' ?>">
      </div>

      <div class="form-group">
        <label>Note:</label>
        <textarea name="note"><?= $editData['note'] ?? '' ?></textarea>
      </div>

      <div class="form-group">
        <?php if (!empty($editData)): ?>
          <button type="submit" name="update_status" class="btn-edit">Update</button>
          <a href="?page=reading" class="btn-cancel">Cancel</a>
        <?php else: ?>
          <button type="submit" name="add_status" class="btn-add">Add</button>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>Member</th>
        <th>Book</th>
        <th>Status</th>
        <th>Start</th>
        <th>Finish</th>
        <th>Rating</th>
        <th>Note</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $statuses = $statusReading->getAll();
        if (!empty($statuses)):
          foreach ($statuses as $s):
      ?>
      <tr>
        <td><?= htmlspecialchars($s['member_name']) ?></td>
        <td><?= htmlspecialchars($s['book_title']) ?></td>
        <td><?= htmlspecialchars($s['status']) ?></td>
        <td><?= $s['start_date'] ?></td>
        <td><?= $s['finish_date'] ?></td>
        <td><?= $s['rating'] ?></td>
        <td><?= htmlspecialchars($s['note']) ?></td>
        <td class="action-buttons-cell">
          <a href="?page=reading&edit=<?= $s['status_id'] ?>" class="btn-edit">Edit</a>
          <a href="?page=reading&delete_status=<?= $s['status_id'] ?>" 
             onclick="return confirm('Delete this record?')" class="btn-delete">Delete</a>
        </td>
      </tr>
      <?php
          endforeach;
        else:
      ?>
        <tr><td colspan="8" style="text-align:center;">No reading data found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
