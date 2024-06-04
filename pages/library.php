<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Librairie");

$qrData = "1/3/45";
function search($dbh, $data){
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
    };
}
function readqr($dbh, $data) 
{
    //ajouter avec des inputs aux favories
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
};

?>
<style>
  img{
    max-width: 150px;
  }
</style>
<form method="post" action="">
    <button type="submit" name="execute_function">Exécuter la fonction PHP</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['execute_function'])) {
    readqr($dbh, $qrData);
}else{
    search($dbh, $_SESSION['liked']);
}






echo foot();
?>