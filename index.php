<?php
session_start();
require './bootstrap.php';
echo head("home");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    dump($_GET);
}

$_SESSION['liked'] = '5/6/14/23';
$_SESSION['disliked'] = '15/7';
dump("liked :" . $_GET['liked']);
dump("disliked :" . $_GET['disliked']);
?>
<a href="./pages/musiswipe.php" role="button">Musiswipe</a>
<a href="./pages/library.php" role="button">Librairie</a>
<a href="./pages/discover.php" role="button">Discover</a>
<?= foot(); ?>