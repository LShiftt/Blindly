<?php
session_start();
require './bootstrap.php';
echo head("home");

$_SESSION['liked'] = '5/6/14/23';
?>
    <a href="./pages/musiswipe.php" role="button">Musiswipe</a>
    <a href="./pages/library.php" role="button">Librairie</a>
    <a href="./pages/discover.php" role="button">Discover</a>
<?= foot();?>