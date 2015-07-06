<?php include('_header.php'); ?>
<div class="alert alertinfo" role="alert">
	Welcome <span class="glyphicon glyphicon-user"></span> <?php echo $login->getUsername(); ?>
	<div class="fr">
		<a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo WORDING_LOGOUT; ?></a> -
		<a href="edit.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo WORDING_EDIT_USER_DATA; ?></a>
	</div>
</div>
<?php
  if ($userActiveLevel==3) {
    $pagetitle = 'Awaiting Confirmation';
    $pagecaption = 'Thank you for uploading your documents, we will confirm your documents and get back to you as soon as possible';
  } elseif ($userActiveLevel==4) {
    $pagetitle = 'Account Activated';
    $pagecaption = 'Your account is active and ready.';
  } else {
    $pagetitle = "You're nearly there!";
    $pagecaption = 'You will need to tell us about your company and upload some required
     documents before you can use the platform.';
  }
?>
<div class="row">
  <div class="col-md-12">
    <center>
      <h1><?php echo $pagetitle; ?></h1>
      <p><?php echo $pagecaption; ?></p>
    </center>
  </div>
  </div>
  <?php if (!$company->newComp_successful): ?>
    <?php if ($userActiveLevel==0 || $userActiveLevel==2) { ?>
    <div class="row white-col">
      <div class="col-md-8">
        <h3 class="blue zero-margtop">Add your company</h3>
        Click 'Add Company'button to submit some required details about your
        company.
      </div>
      <div class="col-md-4">
        <button type="button"
                id="add_new_debtor"
                class="btn btn-default"
                data-toggle="modal"
                data-target="#newcomp">Add Company</button>
        <?php include ('new_company.php') ?>
      </div>
    </div>
    <?php } ?>
  <?php endif; ?>
  <hr />
  <?php if (!$registration->docUpload_successful): ?>
    <?php if ($userActiveLevel==0 || $userActiveLevel==1) { ?>
      <div class="row white-col">
        <div class="col-md-8">
          <h3 class="blue zero-margtop">Upload Documents</h3>
          As part of our policy we require some required documents uploaded.
          These documents will serve as evidence and a form of validity of the
          information you have told us about yourself and your company.
        </div>
        <div class="col-md-4">
          <form method="post" action="register.php" name="postregisterform" enctype="multipart/form-data">
            <div class="form-group">
              <h5>Financial Accounts (Required)</h5>
              <input type="file" name="financial_accounts" id="financial_accounts"  />
            </div>
            <hr />
            <div class="form-group">
              <h5>Last 3 month Bank Statements (Required)</h5>
              <input type="file" name="bank_statements" id="bank_statements"  />
            </div>
            <hr />
            <div class="form-group">
              <h5>Management Accounts (Optional)</h5>
              <input type="file" name="management_accounts" id="management_accounts" />
            </div>
            <hr />
            <div class="form-group">
              <h5>Other Documents (Optional)</h5>
              <input type="file" name="other_doc" id="other_doc" />
            </div>
            <input type="submit" id="postregister_btn" name="postregister" class="btn btn-default" value="Submit" />
          </form>
        </div>
      </div>
    <?php } ?>
  <?php endif; ?>
<?php include('_footer.php'); ?>
