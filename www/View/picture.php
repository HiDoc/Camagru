<div class="container container-explore">
  <div class="row">
    <div class="col-md-6 col-md-offset-1 relative" id="container">
      <div class="row">
        <div class="col-md-12">
          <video autoplay poster="Core/img/loading.gif">
          </video>
          <canvas id="overlay" width="100%" height="504"></canvas>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="bg-title">
            <?php echo Form::create_input('title', 'default')?>
            <?php echo Form::create_textarea('description', 'default')?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
        <div class="row">
          <button id="snap">Snap Photo</button>
        </div>
        <div id="demo" class="row">
        </div>
        <div class="row">
          <button id="save">Save Photo</button>
        </div>
        <div class="row">
          <button id="brightness">Brightness Photo</button>
        </div>
        <div class="row">
          <button id="grayscale">Grayscale Photo</button>
        </div>
      <div class="row">
        <canvas id="canvas" width="300" height="300"></canvas>
      </div>
    </div>
    <div class="col-md-1">
      <div class="row"> <div class="col-md-12"> <button id="wouf" onclick="addFilter('wouf')" class="bg-title"><img src="Storage/filters/wouf.png" height='50' width='50' alt=""></button> </div> </div>
      <div class="row"> <div class="col-md-12"> <button id="bold" onclick="addFilter('bald')" class="bg-title"><img src="Storage/filters/bald.png" height='50' width='50' alt=""></button> </div> </div>
      <div class="row"> <div class="col-md-12"><button id="eye" onclick="addFilter('eye')" class="bg-title"><img src="Storage/filters/eye.png" height='50' width='50' alt=""></button> </div> </div>
      <div class="row"> <div class="col-md-12"><button id="cat" onclick="addFilter('cat')" class="bg-title"><img src="Storage/filters/cat.png" height='50' width='50' alt=""></button> </div> </div>
      <div class="row"> <div class="col-md-12"><button id="mask" onclick="addFilter('mask')" class="bg-title"><img src="Storage/filters/mask.png" height='50' width='50' alt=""></button> </div> </div>
      <div class="row"> <div class="col-md-12"><button id="laugh" onclick="addFilter('laugh')" class="bg-title"><img src="Storage/filters/laugh.png" height='50' width='50' alt=""></button> </div> </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="Core/js/filters.js"> </script>
<script type="text/javascript" src="Core/js/media.js"> </script>
<script type="text/javascript" src="Core/js/picture.js"> </script>
