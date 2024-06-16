<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Musiswipe");


// $_SESSION['liked'] = '2/3/4';
// $_SESSION['disliked'] = '1/5';
// dump($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['liked'])) {

  $_SESSION['liked'] .= "/" . strval($_GET['liked']);
  // dump($_SESSION);

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['disliked'])) {

  $_SESSION['disliked'] .= "/" . strval($_GET['disliked']);
  // dump($_SESSION);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['reset'])) {

  $_SESSION['liked'] = '';
  $_SESSION['disliked'] = '';

}



?>

<style>
  .test-element {
    display: flex;
    flex-flow: column wrap;
    justify-content: center;
    align-items: center;


    max-width: 150px;
    background-color: black;
    z-index: 5;
    position: absolute;
    top: 35vh;
    left: 35vw;
    color: white;
    text-align: center;
    -ms-touch-action: none;
    padding: 1REM;

    overflow: hidden;
    white-space: nowrap;
  }
</style>

<!-- offline -->
<p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
<p id="state"></p>
<div id="target"></div>

<div id="offlineDiv" style="display: none;">
  <img id="offlineImage" src="../media/img/a.png">
  <p>Aie ...</p>
  <?php search($dbh, $_SESSION['liked']); ?>
</div>

<?php $id = tinder($dbh, $_SESSION['liked'], $_SESSION['disliked']);
// dump($id)
?>

<div id="options">
  <a href="./musiswipe.php?liked=<?= $id ?>">J'aime</a>
  <a href="./musiswipe.php?disliked=<?= $id ?>">Je n'aime pas</a>
</div>

<form id="saveLiked" action="" method="get">
  <input id="liked" type="hidden" name="liked" value="">
  <input id="disliked" type="hidden" name="disliked" value="">
</form>
<form action="" method="get">
  <input id="disliked" type="hidden" name="reset" value="1">
  <button type="submit">Reset liked et disliked</button>
</form>
<input id="la"></input>
<input id="le"></input>
<script>
  const la = document.getElementById("la");
  const le = document.getElementById("le");

  const form = document.getElementById("saveLiked");
  const formLiked = document.getElementById("liked");
  const formDisliked = document.getElementById("disliked");
  let isFormSubmitted = false;

  function startDrag(e) {
    if (isFormSubmitted) return;
    this.ontouchmove = this.onmspointermove = moveDrag;

    this.ontouchend = this.onmspointerup = function () {
      this.ontouchmove = this.onmspointermove = null;
      this.ontouchend = this.onmspointerup = null;
    }

    var pos = [this.offsetLeft, this.offsetTop];
    var that = this;
    var origin = getCoors(e);

    function moveDrag(e) {
      var currentPos = getCoors(e);
      var leftInitial = this.style.left;
      la.value = leftInitial;
      var deltaX = currentPos[0] - origin[0];
      var deltaY = currentPos[1] - origin[1];
      this.style.left = (pos[0] + deltaX) + 'px';
      this.style.top = (pos[1] + deltaY) + 'px';
      var deltaXString = deltaX.toString();

      if (pos[0] + deltaX <= -120) {
        le.value = "Pas aimé";
        formDisliked.value = "<?= $id ?>";
        form.submit();
        isFormSubmitted = true;
      } else if (pos[0] + deltaX >= 120) {
        le.value = "Aimé";
        formLiked.value = "<?= $id ?>";
        form.submit();
        isFormSubmitted = true;
      } else if (pos[0] + deltaX >= -50 && pos[0] + deltaX <= 50) {
        le.value = "Neutre";
      }
    }
  }

  function getCoors(e) {
    var coors = [];
    if (e.targetTouches && e.targetTouches.length) {
      var thisTouch = e.targetTouches[0];
      coors[0] = thisTouch.clientX;
      coors[1] = thisTouch.clientY;
    } else {
      coors[0] = e.clientX;
      coors[1] = e.clientY;
    }
    console.log("Coors 2 " + coors);
    return coors;
  }


  const element = document.querySelector('.test-element');
  element.ontouchstart = element.onmspointerdown = startDrag;

  var rect = element.getBoundingClientRect();
  console.log("Initial coordinates: ", rect.left, rect.top);
  document.ongesturechange = function () {
    return false;
  }
</script>

<?= foot(); ?>