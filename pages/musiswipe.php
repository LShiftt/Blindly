<?php
require '../bootstrap.php';
echo head("Blindly - MusiSwipe");


function RNG(){

}
$sql = 'SELECT * FROM `song` WHERE 1 ORDER BY id ASC'; // by random
    $sth = $dbh->prepare($sql);
    $dbh->prepare($sql);
    $sth->execute();
    $songs = $sth->fetchAll();
?>

<style>
  img{
    max-width: 150px;
  }
</style>


<?php

dump($songs);


foreach ($songs as $song) {
  
  echo '
  <article>
  <h1>'.$song["genre"].'</h1>
  <h2>'.$song["title"].', par : <i>'.$song["author"].'</i></h2>
  <img src="'.$song["image"].'">
  <audio controls src="'.$song["url"].'" ></audio>
  <p>'.$song["url"].'</p>
</article>';
};
?>
<?= foot();?>