CREATE DATABASE BookTracker;
USE BookTracker;

CREATE TABLE members (
  member_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE
);

CREATE TABLE books (
  book_id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  author VARCHAR(100) NOT NULL,
  pages INT NOT NULL,
  genre VARCHAR(50) NOT NULL
);

CREATE TABLE reading_status (
  status_id INT AUTO_INCREMENT PRIMARY KEY,
  member_id INT NOT NULL,
  book_id INT NOT NULL,
  status ENUM('In Progress', 'Finished', 'Plan to Read'),
  start_date DATE DEFAULT NULL,
  finish_date DATE DEFAULT NULL,
  rating INT DEFAULT NULL,
  note TEXT,
  FOREIGN KEY (member_id) REFERENCES members(member_id),
  FOREIGN KEY (book_id) REFERENCES books(book_id)
);
