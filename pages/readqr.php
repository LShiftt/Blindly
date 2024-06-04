<?php
require '../../bootstrap.php';
echo head("Blindly - Read Qr Code");

//ici le code qui permet de lire le Qr code via l'api
function readqr($dbh)
{

    $url = "1/3/45";
    $liked = explode('/', $url);

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

    dump($songs);


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
echo foot();