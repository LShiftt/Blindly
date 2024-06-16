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

<!-- Share -->
<p>
    <button onclick="share()">Partage le site</button>
</p>

<!-- offline -->
<p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
<p id="state"></p>
<div id="target"></div>
<div id="offlineDiv" style="display: none;">
    <img id="offlineImage" src="../media/img/a.png">
    <p>Aie ...</p>
    <?php search($dbh, $_SESSION['liked']); ?>
</div>

<h1>QR Code Generator</h1>
<form id="form">
    <label for="text">Text to encode:</label>
    <input type="text" id="text" name="text" required>
    <button type="submit">Generate QR Code</button>
</form>
<div id="qrCodeContainer"></div>
<a id="downloadLink" href="#" download="qrcode.png" style="display: none;">Download QR Code</a>

<h1>QR Code Reader</h1>
<form id="readForm" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    <label for="qrFile">Upload QR Code image:</label>
    <input type="file" id="qrFile" name="file" accept="image/*" required>
    <button type="submit">Vérifier la conformité du QR code</button>
</form>
<div id="qrCodeResult"></div>



<form method="POST" action="">
    <input type="hidden" name="inputData" id="inputData" value="">
    <button type="submit" name="execute_function">Lire le contenue du QR code</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['execute_function'])) {
    readqr($dbh, $_POST['inputData']);
} else {
    search($dbh, $_SESSION['liked']);
}
?>
<?= foot(); ?>