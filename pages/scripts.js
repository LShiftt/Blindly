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
        generateQRCode();
    });

    // QR Code Reading
    document.querySelector('#readForm').addEventListener('submit', function (event) {
        event.preventDefault();
        readQRCode();
    });
});

function generateQRCode() {
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
}

function readQRCode() {
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
                    document.getElementById('inputData').value = data[0].symbol[0].data;
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
}

document.getElementById('status').innerHTML = navigator.onLine ? 'en ligne' : 'hors ligne';

var target = document.getElementById('target');

function handleStateChange() {
    var timeBadge = new Date().toTimeString().split(' ')[0];
    var newState = document.createElement('p');
    var state = navigator.onLine ? 'en ligne' : 'hors ligne';
    newState.innerHTML = '<i class="' + (navigator.onLine ? 'gg-info' : 'gg-danger') + '"></i> ' + timeBadge + ' L\'état de votre connexion viens de changer: vous êtes maintenant ' + state + '.';
    target.appendChild(newState);
}

window.addEventListener('online', handleStateChange);
window.addEventListener('offline', handleStateChange);
