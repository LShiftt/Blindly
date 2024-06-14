<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Musiswipe");


// $_SESSION['liked'] = '';
// $_SESSION['disliked'] = '';
// dump($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['liked'])) {

  $_SESSION['liked'] .= "/" . strval($_GET['liked']);
  dump($_SESSION);

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['disliked'])) {

  $_SESSION['disliked'] .= "/" . strval($_GET['disliked']);
  dump($_SESSION);
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


    background-color: black;
    z-index: 5;
    position: absolute;
    top: 35vh;
    left: 35vw;
    color: white;
    text-align: center;
    -ms-touch-action: none;

    padding: 1REM;
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
dump($id)
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

<script>
  const form = document.getElementById("saveLiked");
  const formLiked = document.getElementById("liked");
  const formDisliked = document.getElementById("disliked");

  function startDrag(e) {
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
      var deltaX = currentPos[0] - origin[0];
      var deltaY = currentPos[1] - origin[1];
      this.style.left = (pos[0] + deltaX) + 'px';
      this.style.top = (pos[1] + deltaY) + 'px';
      var deltaXString = deltaX.toString();
      var regex = '-';

      if (deltaXString.search(regex) !== -1) {
        formDisliked.value = "<?= $id ?>";
        form.submit();
        // 1 second delay
        setTimeout(function () {
          console.log("Executed after 1 second");
        }, 1000);
        return false;

      } else {
        formLiked.value = "<?= $id ?>";
        form.submit();
        // 1 second delay
        setTimeout(function () {
          console.log("Executed after 1 second");
        }, 1000);
        return false;
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