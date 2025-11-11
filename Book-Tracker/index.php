<?php
require_once 'class/Books.php';
require_once 'class/Member.php';
require_once 'class/StatusReading.php';

// Buat objek dari tiap class
$book = new Books();
$member = new Member();
$statusReading = new StatusReading();

$display_page = true;


// CRUD untuk Books
if (isset($_POST['add_book'])) {
    $book->addBook($_POST['title'], $_POST['author'], $_POST['pages'], $_POST['genre']);
    header("Location: index.php?page=books");
    $display_page = false;
}
elseif (isset($_POST['update_book'])) {
    $book->updateBook($_POST['id'], $_POST['title'], $_POST['author'], $_POST['pages'], $_POST['genre']);
    header("Location: index.php?page=books");
    $display_page = false;
}
elseif (isset($_GET['delete_book'])) {
    $book->deleteBook($_GET['delete_book']);
    header("Location: index.php?page=books");
    $display_page = false;
}


// CRUD untuk Members
elseif (isset($_POST['add_member'])) {
    $member->addMember($_POST['name'], $_POST['email']);
    header("Location: index.php?page=members");
    $display_page = false;
}
elseif (isset($_POST['update_member'])) {
    $member->updateMember($_POST['update_member'], $_POST['name'], $_POST['email']);
    header("Location: index.php?page=members");
    $display_page = false;
}

elseif (isset($_GET['delete_member'])) {
    $member->deleteMember($_GET['delete_member']);
    header("Location: index.php?page=members");
    $display_page = false;
}

// CRUD untuk Reading Status
elseif (isset($_POST['add_status'])) {
    $statusReading->addStatus(
        $_POST['member_id'],
        $_POST['book_id'],
        $_POST['status_baca'],
        $_POST['start_date'],
        $_POST['finish_date'],
        $_POST['rating'],
        $_POST['note']
    );
    header("Location: index.php?page=reading");
    $display_page = false;
}
elseif (isset($_POST['update_status'])) {
    $statusReading->updateStatus(
        $_POST['id'],
        $_POST['member_id'],
        $_POST['book_id'],
        $_POST['status_baca'],
        $_POST['start_date'],
        $_POST['finish_date'],
        $_POST['rating'],
        $_POST['note']
    );
    header("Location: index.php?page=reading");
    $display_page = false;
}
elseif (isset($_GET['delete_status'])) {
    $statusReading->deleteStatus($_GET['delete_status']);
    header("Location: index.php?page=reading");
    $display_page = false;
}


// Halaman Default
$page = $_GET['page'] ?? 'books';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Book Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Book Tracker</h1>
           
        </header>

        <nav>
            <ul>
                <li><a href="?page=books" <?= $page == 'books' ? 'class="active"' : '' ?>>Books</a></li>
                <li><a href="?page=members" <?= $page == 'members' ? 'class="active"' : '' ?>>Members</a></li>
                <li><a href="?page=reading" <?= $page == 'reading' ? 'class="active"' : '' ?>>Reading Status</a></li>
            </ul>
        </nav>

        <main>
            <?php
            if ($display_page) {
                if ($page == 'books') include 'view/books.php';
                elseif ($page == 'members') include 'view/members.php';
                elseif ($page == 'reading') include 'view/ReadingStatus.php';
                else echo "<p class='alert alert-warning text-center'>Page not found.</p>";
            }
            ?>
        </main>

        <footer>
            <p>Book Tracker &copy; <?= date('Y'); ?></p>
        </footer>
    </div>
</body>
</html>
