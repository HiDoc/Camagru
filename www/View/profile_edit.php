<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="row"></div>
      <div class="row"></div>
    </div>
    <div class="col-md-6">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="test" class="form-control" id="inputName" placeholder="Name" value="<?= htmlspecialchars($user->getName()); ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputBio" class="col-sm-2 control-label">Bio</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="inputBio" placeholder="Your bio here"><?= htmlspecialchars($user->getBio()); ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="inputLocation" class="col-sm-2 control-label">Location</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputLocation" value="<?= htmlspecialchars($user->getLocation()); ?>" placeholder="Location">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button id="modifyProfile" type="button" class="btn btn-default">Modify</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>

</script>