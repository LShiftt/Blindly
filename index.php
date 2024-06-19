<?php
session_start();
require './bootstrap.php';
echo head("home");

if (!isset($_SESSION['liked'])) {
    $_SESSION['liked'] = '';
}

if (!isset($_SESSION['disliked'])) {
    $_SESSION['disliked'] = '';
}



?>


<main>
    <h1>Bienvenue sur Blindly </h1>
    <p>
        Dans un monde où les options musicales sont infinies, trouver de  nouvelles chansons qui correspondent à vos goûts peut être un véritable  défi. C’est pourquoi nous avons créé <span class="bold">Blindly</span>,  l'application révolutionnaire qui transforme la découverte musicale en  une expérience ludique et personnalisée, inspirée du célèbre modèle de  Tinder.
    </p>
</main>


<!-- offline -->

<div id="offlineDiv" style="display: none;">
    <p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
    <div id="target">
        <p id="state"></p>
    </div>
    <img id="offlineImage" src="./media/img/vinyleImg.png" alt='vinyle'>
    <div id="offline--song">
        <?php search($dbh, $_SESSION['liked']); ?>
    </div>
</div>
<?= foot(); 