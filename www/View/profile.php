<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="panel-title">
        <div class="row">
          <div class="col-md-3 col-md-offset-3">
            <h3><?= htmlspecialchars($user->getUsername()); ?></h3>
          </div>
          <div class="col-md-6">
            <button class="btn btn-default btn-lg" type="button" id="modify" aria-haspopup="true" aria-expanded="false">
              Modify my profile <span class="caret"></span>
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 col-md-offset-3"><?= htmlspecialchars($user->getName()); ?></div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="row" id="edit">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="Core/js/editProfile.js"> </script>