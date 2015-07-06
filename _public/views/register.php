<?php include('_header.php'); ?>

<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
<div class="row">
  <div class="col-md-8">
    <center>
      <h1>Get Started, Register Your Business</h1>
      <h3>Four Simple Steps</h3>
      <p>Registering for an account is simple and hassle free</p>
      <p style="text-align:left;display: block;width: 460px;">
        1. Fill in the form on the right and activate your account instantly<br />
        2. Login and tell us about your business<br />
        3. Upload relavent documents<br />
        4. We will review your account and approve you in no time.<br />
      </p>

      <h3>Need Support?</h3>
      <p>We are always there to support you, write to us via email or call us!</p>
      <p><strong>Email:</strong> support@fundinginvoice.com<br /><strong>Tel:</strong> 0203 23 93 123</p>
    </center>
  </div>
  <div class="col-md-4 white-col">
    <center><h3 class="blue zero-margtop">Create an account</h3></center>
    <hr />
    <form method="post" action="register.php" name="registerform" class="">
        <div class="form-group">
            <label>Account type:</label>
            <select id="user_accountype" class="form-control" type="text" name="user_accounttype" required>
              <option value="1">Business</option>
              <option value="2">Investor</option>
            </select>
            <span id="" class="help-block">Select business if you wish to upload and sell invoices.</span>
        </div>

        <div class="form-group">
            <input id="user_fullname" class="form-control" type="text" name="user_fullname" placeholder="<?php echo WORDING_REGISTRATION_FULLNAME; ?>" required />
        </div>
        <div class="form-group">
            <input id="user_name" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="<?php echo WORDING_REGISTRATION_USERNAME; ?>" required />
        </div>
        <div class="form-group">
            <input id="user_email" class="form-control" type="email" name="user_email" placeholder="<?php echo WORDING_REGISTRATION_EMAIL; ?>" required />
        </div>
        <div class="form-group">
            <input id="user_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" placeholder="<?php echo WORDING_REGISTRATION_PASSWORD; ?>" required autocomplete="off" />
        </div>
        <div class="form-group">
            <input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" placeholder="<?php echo WORDING_REGISTRATION_PASSWORD_REPEAT; ?>" required autocomplete="off" />
        </div>
        <div class="form-group">
            <img src="tools/showCaptcha.php" alt="captcha" /><br />
            <label class="control-label"><?php echo WORDING_REGISTRATION_CAPTCHA; ?></label>
            <input type="text" name="captcha" required />
        </div>
        <div class="form-group">
             <button type="submit" name="register" class="btn btn-default"><?php echo WORDING_REGISTER; ?></button>
        </div>
    </form>
  </div><!-- /.col-md-5 -->
</div> <!-- /.row -->
<?php } ?>

    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
