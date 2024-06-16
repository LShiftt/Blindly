<?php
/**
 * Affiche le head du HTML.
 *
 * @param string $title  le titre de la page.
 * @return void
 */

function head(string $title = ''): string
{   
    
    if ( !str_contains($_SERVER['SCRIPT_FILENAME'],'index.php')) {
        $links_css='
                    <link rel="stylesheet" href="../assets/css/global/global.css">
                    <link rel="stylesheet" href="../assets/css/global/header.css">
                    <link rel="stylesheet" href="../assets/css/global/nav.css">
                    <link rel="stylesheet" href="../assets/css/global/footer.css">
                    <link rel="stylesheet" href="../assets/css/global/theme.css">
        ';
        $link_icone ='../media/img/Icone.png';

    }
    else {
        $links_css='
                <link rel="stylesheet" href="./assets/css/global/global.css">
                <link rel="stylesheet" href="./assets/css/global/header.css">
                <link rel="stylesheet" href="./assets/css/global/nav.css">
                <link rel="stylesheet" href="./assets/css/global/footer.css">
                <link rel="stylesheet" href="./assets/css/global/theme.css">

                <link rel="stylesheet" href="./assets/css/index.css">
        
        ';
        $link_icone ='./media/img/Icone.png';

    }

    if (str_contains($_SERVER['SCRIPT_FILENAME'],'musiswipe.php')) {
        $link_musiswpie = '<link rel="stylesheet" href="../assets/css/musiswipe.css">';
    }
    else {
        $link_musiswpie = '';
    }

    if (str_contains($_SERVER['SCRIPT_FILENAME'],'library.php')) {
        $link_library = '<link rel="stylesheet" href="../assets/css/library.css">';
    }
    else {
        $link_library = '';
    }

    return <<<HTML_HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    $links_css
    $link_musiswpie
    $link_library

    <script src="https://kit.fontawesome.com/1ce9ab38cd.js" crossorigin="anonymous"></script>

  <style>
  img {
    max-width: 150px;
    }
  </style>

  <title>$title</title>
</head>
<body data-theme='light'>
    <nav id="nav" popover>
        <a href="./index.php"><img src="$link_icone" alt="Icone Blindly" class="icone" id="nav--icone"></a>
        <div class="nav--menu">
            <a href="" class="nav--menu--link">
                <i class="fa-solid fa-heart-circle-plus"  style="color:var( --text-color);"></i>
                <p>MusiSwipe</p>
            </a>
            <a href="" class="nav--menu--link">
                <i class="fa-solid fa-folder-tree" style="color:var( --text-color);"></i>
                <p>Discovery</p>
            </a>
            <a href="" class="nav--menu--link">
                <i class="fa-solid fa-folder" style="color: var( --text-color);"></i>
                <p>Librairie</p>
            </a>
        </div>
        <button id="btn-menu-close" popovertarget="nav" popovertargetaction="hide"><i class="fa-solid fa-xmark"></i></button>
        <div class="nav--luminosity">
            <i class="fa-solid fa-sun" style="color:var( --text-color);"></i>
        </div>
    </nav>
    <header>
        <button id="btn-menu-open" popovertarget="nav" popovertargetaction="show">Menu</button>
        <img src="$link_icone" alt="Icone Blindly" class="icone" id="icone--header">
    </header>
HTML_HEAD;
}

function foot(): string
{
    if ( !str_contains($_SERVER['SCRIPT_FILENAME'],'index.php')) {
        $scripts_js='
            <script src="../assets/js/scripts.js"></script>
            <script src="../assets/js/luminosity.js"></script>

        ';
    }
    else {
        $scripts_js='
        <script src="./assets/js/luminosity.js"></script>
        <script src="./assets/js/scripts.js"></script>

        
        ';
    }



    return <<<HTML_FOOT

    
    <footer>
            <p>Blindly</p>
            <a href=""><p>Mentions légales</p></a>
            <p>Création par Cédric Tanghe et Mathis Dubois</p>
    </footer>
    $scripts_js
 
</body>
</html>
HTML_FOOT;
}

function search($dbh, $data)
{
    $liked = str_getcsv($data, '/');
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
    $liked = str_getcsv($data, '/');
    $disliked = str_getcsv($data2, '/');

    $placeholders = implode(',', array_fill(0, count($liked) + count($disliked), '?'));

    $all = array_merge($liked, $disliked);

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
    $liked = str_getcsv($data, '/');
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