<div class="container signin-box">
  <div class="row">
   <div class="col-md-6">
      <?php $form = new Form([
        'name' => ['required' => 1],
        'username' => ['required' => 1],
        'email' => ['required' => 1, 'type' =>'email'],
        'password' => ['required' => 1, 'type' =>'password'],
        'verify password' => ['required' => 1, 'type' =>'password'],
        'location' => ''],
        "signup",
        "New Account");
        echo $form->__toString();
     ?>
    </div>
    <div class="col-md-6 align-middle">
      <h2>Welcome to Focus .42</h2>
      <p>Try our App to instantly take portraits of yourself or friends that you’ll want to share</p>
      <p>Use our creative tools to let your imagination run wild</p>
    </div>
  </div>
</div>
