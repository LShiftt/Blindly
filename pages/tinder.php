<?php
require '../bootstrap.php';
echo head("Blindly - Tinder");
?>
<style>
  img{
    max-width: 150px;
  }
</style>
<figure>
  <figcaption>La musique actuelle</figcaption>
  <img src="https://img.freepik.com/vecteurs-libre/contexte-citation-romantique_23-2147785280.jpg?w=826&t=st=1716898735~exp=1716899335~hmac=453d12c1e3e230ee6ed84bbeda44d086f4bf180624d6ae30b6708c4f1c890e3d" alt="">
  <audio controls src="../media/song/AlwaysandForever.mp3" autoplay></audio>
</figure>

<?= foot();?>