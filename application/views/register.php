<div class="register-box">
    <div class="card">
  <div class="card-header">
    <div class="register-logo">
      <a href=""><b>Register</b>Page</a>
    </div>  
    <h4 class="text-center">Register</h4>
  </div>
    <div class="card-body register-card-body">
      <form action="<?= base_url('controller_function/register') ?>" method="post">
         <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
        <small class="text-danger"><?= form_error('username') ?></small>
        <div class="input-group mb-3">      
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <small class="text-danger"><?= form_error('email') ?></small>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <small class="text-danger"><?= form_error('password') ?></small>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="retype-password">
          <div class="input-group-append input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <small class="text-danger"><?= form_error('retype-password') ?></small>
        <div class="g-recaptcha" name="captcha" data-sitekey="6LcmPasUAAAAACckCU6GUngDICjZTDqyWkuUJZ0s"></div>
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4 mt-2">
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
              <div class="card-footer">
       <small>Already have an account?</small>
       <a href="<?= base_url('controller_function')  ?>" class="text-center">Sign in</a>
      </div>
    </div><!-- /.card -->

  </div>
       <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <script>
      grecaptcha.ready(function() {
      grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
      ...
      });
      });
      </script>