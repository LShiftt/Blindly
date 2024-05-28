<?php
require '../bootstrap.php';
echo head("Blindly - MusiSwipe");

$sql = 'SELECT * FROM `song` WHERE 1 ORDER BY id ASC';
$songs = $dbh->query($sql)->fetchAll();

?>

<style>
  img{
    max-width: 150px;
  }
</style>


<?php foreach ($songs as $song) {
  dump($song);
  echo '<figure>
  <figcaption>'.$song["title"].' par '.$song["author"].'</figcaption>
  <img src="'.$song["image"].'">
  <audio controls src="'.$song["url"].'" autoplay></audio>
</figure>';
};
?>
<?= foot();?>