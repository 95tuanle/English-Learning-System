<?php
session_start();

$conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM words WHERE id='".$_GET['id']."'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: ../manage_words.php");
}