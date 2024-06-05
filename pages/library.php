<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Librairie");


function search($dbh, $data)
{
    $liked = explode('/', $data);

    $whereClauses = array();
    foreach ($liked as $value) {
        $whereClauses[] = "id = " . intval($value);
    }
    $where = implode(' OR ', $whereClauses);


    $sql = 'SELECT * FROM `song` WHERE ' . $where . ' ORDER BY id ASC';
    $sth = $dbh->prepare($sql);
    $dbh->prepare($sql);
    $sth->execute();
    $songs = $sth->fetchAll();

    // dump($songs);


    foreach ($songs as $song) {
        // il faut trier les chansons récup par genre puis les affichées 
        echo '
  <article>
  <h1>' . $song["genre"] . '</h1>
  <h2>' . $song["title"] . ', par : <i>' . $song["author"] . '</i></h2>
  <img src="' . $song["image"] . '">
  <audio controls src="' . $song["url"] . '" ></audio>
  <p>' . $song["url"] . '</p>
</article>';
    }
    ;
}
function readqr($dbh, $data)
{
    //ajouter avec des inputs aux favories
    $liked = explode('/', $data);

    $whereClauses = array();
    foreach ($liked as $value) {
        $whereClauses[] = "id = " . intval($value);
    }
    $where = implode(' OR ', $whereClauses);


    $sql = 'SELECT * FROM `song` WHERE ' . $where . ' ORDER BY id ASC';
    $sth = $dbh->prepare($sql);
    $dbh->prepare($sql);
    $sth->execute();
    $songs = $sth->fetchAll();

    // dump($songs);

    foreach ($songs as $song) {

        echo '
  <article>
  <h1>' . $song["genre"] . '</h1>
  <h2>' . $song["title"] . ', par : <i>' . $song["author"] . '</i></h2>
  <img src="' . $song["image"] . '">
  <audio controls src="' . $song["url"] . '" ></audio>
  <p>' . $song["url"] . '</p>
</article>';
    }
    ;
}
;

?>
<!-- Share -->
<p>
    <button onclick="share()">Partage le site</button>
</p>
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




<!-- Place this just before the closing </body> tag -->
<script>
    function share() {
        if (!("share" in navigator)) {
            alert('Web Share API n\'est pas supportée, fonctionnalité incompatible avec votre navigateur');
            return;
        }

        navigator.share({
            title: 'Ceci est titre',
            text: 'Ceci est un text',
            url: 'https://mdubois.alwaysdata.net/Blindly'
        })
            .then(() => console.log('Successful share'))
            .catch(error => console.log('Error sharing:', error));
    }
    document.addEventListener('DOMContentLoaded', (event) => {
        const inputData = document.querySelector('#inputData');

        // QR Code Generation
        document.querySelector('#form').addEventListener('submit', function (event) {
            event.preventDefault();
            const text = document.getElementById('text').value;
            const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&format=png&data=${encodeURIComponent(text)}`;

            fetch(qrCodeUrl)
                .then(response => response.blob())
                .then(blob => {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(blob);
                    const qrCodeContainer = document.getElementById('qrCodeContainer');
                    qrCodeContainer.innerHTML = '';
                    qrCodeContainer.appendChild(img);

                    // Create download link
                    const downloadLink = document.getElementById('downloadLink');
                    downloadLink.href = img.src;
                    downloadLink.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error generating QR code:', error);
                });
        });

        // QR Code Reading
        document.querySelector('#readForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const fileInput = document.getElementById('qrFile');
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('file', file);

                fetch('https://api.qrserver.com/v1/read-qr-code/', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        const resultContainer = document.getElementById('qrCodeResult');
                        resultContainer.innerHTML = '';
                        if (data[0] && data[0].symbol[0] && data[0].symbol[0].data) {
                            resultContainer.textContent = 'QR Code Valide ';
                            inputData.value = data[0].symbol[0].data;
                            console.log('QR Code Data: ' + data[0].symbol[0].data);
                        } else {
                            resultContainer.textContent = 'No data found in QR code.';
                            console.log('No data found in QR code.');
                        }
                    })
                    .catch(error => {
                        console.error('Error reading QR code:', error);
                        document.getElementById('qrCodeResult').textContent = 'Error reading QR code.';
                    });
            }
        });
    });
</script>
<form method="POST" action="">
    <input type="hidden" name="inputData" id="inputData" value="">
    <button type="submit" name="execute_function">Lire le contenue du QR code</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['execute_function'])) {
    $_POST['inputData'];
    readqr($dbh, $_POST['inputData']);

} else {
    search($dbh, $_SESSION['liked']);
}
?>
<?= foot(); ?>