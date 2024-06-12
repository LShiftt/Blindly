<?php
session_start();
require '../bootstrap.php';
echo head("Blindly - Musiswipe");
// il faut remettre le cube noir au millieu de l'acran !

?>
<style>
  .test-element {
    height: 100px;
    background-color: black;
    width: 100px;
    z-index: 5;
    position: absolute;
    top: 40vh;
    left: 49vw;
    color: white;
    text-align: center;
    -ms-touch-action: none;
  }
</style>

<!-- offline -->
<p>L'état de votre connexion est <b id="status">en ligne</b>.</p>
<div id="target"></div>
<div id="offlineDiv" style="display: none;">
    <img id="offlineImage" src="../media/img/a.png">
    <p>Aie ...</p>
    <?php search($dbh, $_SESSION['liked']); ?>
    
</div>


<div class="test-element">Element</div>
<input class="text" type="text">

<script>
  const text = document.querySelector('.text');
  function startDrag(e) {

    this.ontouchmove = this.onmspointermove = moveDrag;

    this.ontouchend = this.onmspointerup = function () {
      this.ontouchmove = this.onmspointermove = null;
      this.ontouchend = this.onmspointerup = null;
    }

    var pos = [this.offsetLeft, this.offsetTop];
    text.value = pos;
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
        that.style.color = "white";

      } else {
        that.style.color = "red";
        document.location.href="../index.php"; //on est ici
      }

      return false; // cancels scrolling
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
    function nextPage(e) {

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