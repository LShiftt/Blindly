<?php
session_start();
require './bootstrap.php';
echo head("home");




?>

<!-- offline -->
<p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
<p id="state"></p>
<div id="target"></div>
<div id="offlineDiv" style="display: none;">
    <img id="offlineImage" src="./media/img/a.png">
    <p>Aie ...</p>
    <?php search($dbh, $_SESSION['liked']); ?>
</div>

<a href="./pages/musiswipe.php" role="button">Musiswipe</a>
<a href="./pages/library.php" role="button">Librairie</a>
<a href="./pages/discover.php" role="button">Discover</a>
<?= foot(); ?>