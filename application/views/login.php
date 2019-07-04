<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-header">
      <div class="login-logo">
        <a href="#"><b>Login</b>Page</a>
      </div>
      <h4 class="text-center">Sign In</h4>
    </div>
    <div class="card-body login-card-body">
      <form action="<?= base_url('Controller_Function') ?>" method="post">
        <?= $this->session->flashdata('message'); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <small class="text-danger"> <?= form_error('email') ?></small>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <small class="text-danger"> <?= form_error('password') ?></small>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
      </form>
    </div>
          <div class="card-footer">
        <p class="mt-3">
          <small>Doesn't have an account?</small>
          <a href="<?= base_url('controller_function/register') ?>">Register Here</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>