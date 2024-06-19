<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Librairie");

if (!isset($_SESSION['liked'])) {
    $_SESSION['liked'] = '';
}

if (!isset($_SESSION['disliked'])) {
    $_SESSION['disliked'] = '';
}
?>





<main class="library">
    <section class="library--header">
        <div class="library--title">
            <i class="fa-solid fa-folder icone--library" style="color: var( --text-color);"></i>
            <h1>Librairie</h1>
        </div>
        <div class="library--options">
            <!-- Bouton Génrèrant le QR code-->
            <button popovertarget="export" popovertargetaction="toggle" type="submit" class="btn library--btn" id="btn-export" >Enregistrer vos musiques</button>
            <button  class="library--btn btn" id="btn-import" popovertarget="import" popovertargetaction="toggle">Importer une playlist</button>
            <!-- Share -->
            <button onclick="share()" class="library--btn btn">Partage le site</button>
        </div>
    </section>

<!-- Ensemble des boutons pour l'affichage librairie -->
    <div class="library--import" id="import"  popover>
        <!--Upload et validation Conformité-->
        <form id="readForm" enctype="multipart/form-data" class="form-getImage">
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
            <label for="qrFile">Importer une playlist</label>
            <input type="file" id="qrFile" name="file" accept="image/*"  required>
            <button type="submit" class='library--btn btn'>Valider la conformité</button>
        </form>
        
    <!--Affichage du contenu via QRCode -->
        <form method="POST" action="" >
            <input type="hidden" name="inputData" id="inputData" value="">
            <button type="submit" name="execute_function" class='library--btn btn' id="print-btn">Afficher</button>
        </form>
            <!--Message d'erreur-->
        <div id="qrCodeResult"></div>
    </div>

<!-- Générer QR CODE et possibilité de le télcharger -->
<div class="library--export" id="export" popover>
    <h2>Exporter vos musiques</h2>
    <p>Ce QRcode va permettre de pouvoir garder les chansons que vous aurez aimé </p>
    <form id="form" class="library--form">
        <input type="hidden" id="text"  name="text" value="<?= $_SESSION['liked']?>" required>
        <button popovertarget="export" popovertargetaction="toggle" type="submit" class="btn" id="QrCode-create" >Générer un QRcode</button>
    </form>
    <!--Affichage du QRCode-->
    <div id="qrCodeContainer"></div>
    <!--Download le QRCode-->
    <a id="downloadLink" href="#" download="qrcode.png">Télécharger le QRcode</a>

</div>

<section class="Songs">
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['execute_function'])) {
        readqr($dbh, $_POST['inputData']);
    } else {
        search($dbh, $_SESSION['liked']);
    }
    ?>
</section>





</main>

<!-- offline -->

<div id="offlineDiv" style="display: none;">
    <p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
    <div id="target">
        <p id="state"></p>
    </div>
    <img id="offlineImage" src="../media/img/vinyleImg.png" alt='vinyle'>
    <div id="offline--song">
        <?php search($dbh, $_SESSION['liked']); ?>
    </div>
</div>





<!--Message d'erreur-->
<!-- <div id="qrCodeResult"></div> -->





<?= foot(); ?>