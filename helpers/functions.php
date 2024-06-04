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
<footer>
</footer>
</body>
</html>
HTML_FOOT;
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