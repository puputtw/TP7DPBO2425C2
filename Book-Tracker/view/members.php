<?php

//ambil data lama
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $member->getById($_GET['edit']);
}
?>

<section class="data-list">
  <h2>Members</h2>

  <div class="form-container">
    <form method="post">
      <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $editData['name'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" value="<?= $editData['email'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <?php if (!empty($editData)): ?>
          <button type="submit" name="update_member" value="<?= $editData['member_id'] ?>" class="btn-edit">Update</button>
          <a href="?page=members" class="btn-cancel">Cancel</a>
        <?php else: ?>
          <button type="submit" name="add_member" class="btn-add">Add Member</button>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>

    <?php
      $members = $member->getAll();
      if (!empty($members)):
        foreach ($members as $m):
    ?>
    <tr>
      <td><?= $m['member_id'] ?></td>
      <td><?= htmlspecialchars($m['name']) ?></td>
      <td><?= htmlspecialchars($m['email']) ?></td>
      <td class="action-buttons-cell">
        <a href="?page=members&edit=<?= $m['member_id'] ?>" class="btn-edit">Edit</a>
        <a href="?page=members&delete_member=<?= $m['member_id'] ?>" onclick="return confirm('Delete this member?')" class="btn-delete">Delete</a>
      </td>
    </tr>
    <?php
        endforeach;
      else:
    ?>
      <tr><td colspan="4" style="text-align:center;">No members found.</td></tr>
    <?php endif; ?>
  </table>
</section>
