<?php
session_start();

if (!$_SESSION['is_logged_in']) {
    header("Location: login.php");
} else {
    if ($_SESSION['is_admin_logged_in']) {
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Words</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="icon" href="assets/logo.png" type="image/png"
</head>
<body>
<div class="jumpotron-fluid">
    <img src="assets/banner.png" class="img-fluid" alt="">
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top justify-content-center">
    <a class="navbar-brand" href="index.php"><img src="assets/logo.png" width="30" height="30" alt=""></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="add_a_word.php">Add a word</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="manage_words.php">Manage words</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="learn_a_word.php">Learn a word</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </ul>
</nav>
<br>
        <?php
            $conn = mysqli_connect("s3618861-db.cavq78vobfpn.ap-southeast-1.rds.amazonaws.com", "imhikarucat", "12345abcde", "tuanle");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM words ORDER BY RAND() LIMIT 1";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                $row = mysqli_fetch_assoc($data);
                $word = $row["word"];
                $vietnamese_meaning = $row["vietnamese_meaning"];
                $similar_words = $row["similar_words"];
                $example_one = $row["example_one"];
                $example_two = $row["example_two"];
                echo "<div class='container'>";

                echo "<h1>Word: $word</h1>";
                echo "<br>";
                echo "<p>Vietnamese meaning: $vietnamese_meaning</p>";
                echo "<p>Similar words: $similar_words</p>";
                echo "<p>Example 1: $example_one</p>";
                echo "<p>Example 2: $example_two</p>";
                echo "<a href='learn_a_word.php'>Learn another word</a>";
                echo "</div>";
            }
            mysqli_close($conn);
        ?>

<br>
<footer class="page-footer font-small lighten-5"">
<div class="footer-copyright text-center text-black-50 py-3">
    <p>Copyright &copy; <?php echo date('Y') ?> Tuan Le</p>
</div>
</body>
</html>