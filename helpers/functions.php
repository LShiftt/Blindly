<?php
/**
 * Affiche le head du HTML.
 *
 * @param string $title  le titre de la page.
 * @return void
 */

function head(string $title = ''): string
{
    return <<<HTML_HEAD
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  img {
    max-width: 150px;
}
  </style>

  <title>$title</title>
</head>
<body>
<header>
</header>
HTML_HEAD;
}

function foot(): string
{
    return <<<HTML_FOOT
    <script src="/assets/js/scripts.js"></script>
    <script src="../assets/js/scripts.js"></script>
<footer>
</footer>
</body>
</html>
HTML_FOOT;
}

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
    $sth->execute();
    $songs = $sth->fetchAll();

    foreach ($songs as $song) { // rangé par genre
        echo '
  <article>
  <h1>' . $song["genre"] . '</h1>
  <h2>' . $song["title"] . ', par : <i>' . $song["author"] . '</i></h2>
  <img src="' . $song["image"] . '">
  <audio controls src="' . $song["url"] . '" ></audio>
</article>';
    }
}

function tinder($dbh, $data, $data2)
{
    // Convertir les données en tableaux
    $liked = explode('/', $data);
    $disliked = explode('/', $data2);

    // Créer les placeholders pour les IDs
    $placeholders = implode(',', array_fill(0, count($liked) + count($disliked), '?'));

    // Fusionner les tableaux liked et disliked pour les utiliser dans la requête
    $all = array_merge($liked, $disliked);

    // Requête SQL pour sélectionner une chanson aléatoire qui n'est ni likée ni dislikée
    $sql = 'SELECT * FROM `song` WHERE id NOT IN (' . $placeholders . ') ORDER BY RAND() LIMIT 1';
    $sth = $dbh->prepare($sql);
    $sth->execute($all);
    $song = $sth->fetch();

    if ($song) {
        echo '
        <article class="test-element">
            <h1>' . $song["genre"] . '</h1>
            <h2>' . $song["title"] . ', par : <i>' . $song["author"] . '</i></h2>
            <img src="' . $song["image"] . '">
            <audio controls src="' . $song["url"] . '"></audio>
        </article>';
        return $id = $song["id"];
    } else {
        echo '<p>Vous avez fini le test</p>';
    }
}


function readqr($dbh, $data)
{
    $liked = explode('/', $data);
    $whereClauses = array();
    foreach ($liked as $value) {
        $whereClauses[] = "id = " . intval($value);
    }
    $where = implode(' OR ', $whereClauses);

    $sql = 'SELECT * FROM `song` WHERE ' . $where . ' ORDER BY id ASC';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $songs = $sth->fetchAll();

    foreach ($songs as $song) {
        echo '
        <article class="test-element">
            <h1>' . $song["genre"] . '</h1>
            <h2>' . $song["title"] . ', par : <i>' . $song["author"] . '</i></h2>
            <img src="' . $song["image"] . '">
            <audio controls src="' . $song["url"] . '"></audio>
        </article>';
    }
}

function validateDate($date, $format = 'Y-m-d'): bool
{
    // replace a 'Z' at the end by '+00:00'
    $date = preg_replace('/(.*)Z$/', '${1}+00:00', $date);

    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) == $date;
}
function isGetMethod(): bool
{
    return ($_SERVER['REQUEST_METHOD'] === 'GET');
}

function isPostMethod(): bool
{
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
}