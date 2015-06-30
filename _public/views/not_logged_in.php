<?php include('_header.php'); ?>

<!--
<form method="post" action="index.php" name="loginform">
    <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
    <input id="user_name" type="text" name="user_name" required />
    <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
    <input id="user_password" type="password" name="user_password" autocomplete="off" required />
    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
    <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
    <input type="submit" name="login" value="<?php echo WORDING_LOGIN; ?>" />
</form> -->
<div class="row">
	<div class="col-md-4">
		<h3>Sign In</h3>
	</div>
	<div class="col-md-8">
		<h3></h3>
	</div>
</div>
<div class="row">
	<div class="col-md-4 white-col">
			<form class="" method="post" action="index.php" name="loginform">
			  <div class="form-group">
			    <label for="user_name" class="control-label"><?php echo WORDING_USERNAME; ?></label>
			      <input class="form-control" id="user_name" type="text" name="user_name" required />
			  </div>
			  <div class="form-group">
			    <label for="user_password" class="control-label"><?php echo WORDING_PASSWORD; ?></label>
			      <input class="form-control" id="user_password" type="password" name="user_password" autocomplete="off" required />
			  </div>
			  <div class="form-group">
			      <div class="checkbox">
			        <label>
			          <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" /> <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
			        </label>
			      </div>
			  </div>
			  <div class="form-group">
		      <center>
		      	<input type="submit" name="login" class="btn btn-default" value="<?php echo WORDING_LOGIN; ?>" />
		  		</center>
			  </div>
			</form>

			<a href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a> | 
			<a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
		
	</div><!-- /.col-md-4 -->
	<div class="col-md-4">
		<center>
		<h3>Superior Invoice Trading Platform</h3>
		<p>Get ahead of the competition and increase your liquidity and ability to react to changes through our financial systems and expertise.</p>
		<p>Our system is hassle free, we are working hard to review, approve and transfer funds in less than 24hrs</p>
		</center>
	</div>
	<div class="col-md-4">
		<center>
		<h3>We are here to help you</h3>
			<p>Do you have a question or need help in understanding how our services can support your business? Do not hesistate to email or call us now, too busy now? Email us a convinient time for you and we will call you back!</p>
			<p><strong>Email:</strong> support@fundinginvoice.com<br /><strong>Tel:</strong> 0203 23 93 123</p>
		</center>
	</div>
</div><!-- /.row -->
<?php include('_footer.php'); ?>
