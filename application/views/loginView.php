<div class='col-md-offset-3 col-md-7'>
  <?= validation_errors(); ?>
  <?= form_open('verifyLogin'); ?>
  <div class="form-group">
      <h2>Inloggen:</h2><hr style='border:1px solid #a5a5a5;'/>
    <label class="control-label" for="inputEmail">Emailadres:</label>
    <div class="controls">
      <input type="text" class="form-control" id="inputEmail" name="email" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label" for="inputPassword">Wachtwoord</label>
    <div class="controls">
      <input type="password" class="form-control" id="inputPassword" name="password" required>
    </div>
  </div>
  <div class="form-group">
    <div class="controls">
      <button type="submit" name="submit" value="login" class='btn btn-default'>login</button>
    </div>
  </div>
  <?= form_close(); ?>
</div>