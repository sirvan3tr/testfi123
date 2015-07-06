<?php include('_header.php'); ?>

<div class="alert alertinfo" role="alert">
	Welcome <span class="glyphicon glyphicon-user"></span> <?php echo $login->getUsername(); ?>
	<div class="fr">
		<a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo WORDING_LOGOUT; ?></a> -
		<a href="edit.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo WORDING_EDIT_USER_DATA; ?></a>
	</div>
</div>

<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
  <li role="presentation"><a href="#active_invoices" aria-controls="active_invoices" role="tab" data-toggle="tab">Active Invoices</a></li>
  <li role="presentation"><a href="#my_invoices" aria-controls="my_invoices" role="tab" data-toggle="tab">My Invoices</a></li>
</ul>

<div class="tab-content customseller">
  <div role="tabpanel" class="tab-pane active" id="home">
 	<div class="row">
	  <div class="col-md-6">

	  	<h3 class="blue zero-margtop">Invoice Statistics</h3>
			<?php
				$under_review = ORM::for_table('invoice')
					->where('author_id', $userid)
					->where('status', 1)
					->count();
				$traded = ORM::for_table('invoice')
					->where('author_id', $userid)
					->where('status', 3)
					->count();
				$purchased = ORM::for_table('invoice')
					->where('author_id', $userid)
					->where('status', 4)
					->count();
				$expired = ORM::for_table('invoice')
					->where('author_id', $userid)
					->where('status', 5)
					->count();
				$completed = ORM::for_table('invoice')
					->where('author_id', $userid)
					->where('status', 6)
					->count();
			?>
	  		<div class="invoice_stats_parent">
	  			<div class="invoice_stat_el">Under Review<span class="invoice_stat_no"><?php echo $under_review ?></span><span class="invoice_stat_val">£</span></div>
	  			<div class="invoice_stat_el">Traded<span class="invoice_stat_no"><?php echo $traded ?></span><span class="invoice_stat_val">£</span></div>
	  			<div class="invoice_stat_el">Purchased<span class="invoice_stat_no"><?php echo $purchased ?></span><span class="invoice_stat_val">£</span></div>
	  			<div class="invoice_stat_el">Expired<span class="invoice_stat_no"><?php echo $expired ?></span><span class="invoice_stat_val">£</span></div>
	  			<div class="invoice_stat_el">Completed<span class="invoice_stat_no"><?php echo $completed ?></span><span class="invoice_stat_val">£</span></div>
	  			<div class="clear"></div>
	  		</div>
	    <p>To get going you will need to upload an Invoice for us to approve and upon approval you can set automatic trade where your invoice will be automatically placed on the market for potential investors and buyers to purchase, else you can get a notification and decide when to place your trade after approval.</p>
			<a href="new_invoice.php" type="button" class="btn btn-warning">
				<span class="glyphicon glyphicon-pencil"></span> New Invoice
			</a>
	  </div>
	  <div class="col-md-3">
	  	<h3>Your Company</h3>
			<?php
				$company = ORM::for_table('company')
					->where('users_id', $userid)
					->where('company_type', 2)
					->find_one();

				echo '<strong>Name:</strong> '.$company->name.'<br />';
				echo '<strong>Industry:</strong> '.$company->industry.'<br />';
				echo '<strong>Revenue:</strong> '.$company->revenue.'<br />';
				echo '<strong>Contact Name:</strong> '.$company->contact_name.'<br />';
				echo '<strong>Address 1:</strong> '.$company->contact_address_1.'<br />';
				echo '<strong>Address 2:</strong> '.$company->contact_address_2.'<br />';
				echo '<strong>Address 3:</strong> '.$company->contact_address_3.'<br />';
				echo '<strong>PostCode:</strong> '.$company->contact_address_postcode.'<br />';
			?>
	  </div>
		<div class="col-md-3">
			<h3>Notifications</h3>
			<p>
				You have no notifications.
			</p>
		</div>
	</div>
  </div><!-- home tab end -->
  <div role="tabpanel" class="tab-pane" id="active_invoices">
  	<h3>Active Invoices</h3>
  	<table class="table">
  	<thead>
  		<tr>
  			<th>Status</th>
  			<th>ID</th>
  			<th>Invoice Number</th>
  			<th>Value £</th>
  			<th>Invoice Length</th>
  			<th>Issue Date</th>
  			<th>Payment Date</th>
  			<th>Expected Date</th>
  			<th>Fees £</th>
  			<th>Invoice Files</th>
  			<th>Publication Date</th>
  			<th>Actions</th>
  		</tr>
  		</thead>
  	<?php
  		$invoices = ORM::for_table('invoice')
  			->where('author_id', $userid)
  			->where_lte('status', 2)
  			->find_many();
		foreach ($invoices as $invoice) {
			$totalfees = $invoice->listing_fee+$invoice->buyer_fee;
			if ($invoice->status == 1){
				$icon = '<span class="glyphicon glyphicon-exclamation-sign"></span> Awaiting Approval';
				$action = 'Email';
			} else if($invoice->status == 2) {
				$icon = '<span class="glyphicon glyphicon-thumbs-up"></span> Approved';
				$action = 'Trade';
			} else if($invoice->status == 3) {
				$icon = '<span class="glyphicon glyphicon-globe"></span> Traded';
				$action = 'Remove';
			} else if($invoice->status == 4) {
				$icon = '<span class="glyphicon glyphicon-ok"></span> Purchased';
				$action = 'View Details';
			} else if($invoice->status == 5) {
				$icon = '<span class="glyphicon glyphicon-flag"></span> Expired';
				$action = 'View Details';
			}
			echo '<tr>';
			echo '<td>'.$icon.'</td>';
			echo '<td>'.$invoice->invoice_id.'</td>';
			echo '<td>'.$invoice->number.'</td>';
  			echo '<td>£'.$invoice->value.'</td>';
  			echo '<td>'.$invoice->invoice_length.'</td>';
  			echo '<td>'.$invoice->issue_date.'</td>';
  			echo '<td>'.$invoice->payment_date.'</td>';
  			echo '<td>'.$invoice->expected_date.'</td>';
  			echo '<td>£'.$totalfees.'</td>';
  			echo '<td></td>';
  			echo '<td>'.$invoice->pub_date.'</td>';
  			echo '<td style="text-align:center;"><a href="#"><span class="glyphicon glyphicon-menu-hamburger"></span></a></td>';
			echo '</tr>';
		}
  	?>
  	</table>
  </div>
  <div role="tabpanel" class="tab-pane" id="my_invoices">
  	<h3>All Invoices</h3>
  	<table class="table">
  	<thead>
  		<tr>
  			<th>Status</th>
  			<th>ID</th>
  			<th>Invoice Number</th>
  			<th>Value £</th>
  			<th>Invoice Length</th>
  			<th>Issue Date</th>
  			<th>Payment Date</th>
  			<th>Expected Date</th>
  			<th>Fees £</th>
  			<th>Invoice Files</th>
  			<th>Publication Date</th>
  			<th>Actions</th>
  		</tr>
  		</thead>
  	<?php
  		$invoices = ORM::for_table('invoice')->where('author_id', $userid)->find_many();
		foreach ($invoices as $invoice) {
			$totalfees = $invoice->listing_fee+$invoice->buyer_fee;
			if ($invoice->status == 1){
				$icon = '<span class="glyphicon glyphicon-exclamation-sign"></span> Awaiting Approval';
				$action = 'Email';
			} else if($invoice->status == 2) {
				$icon = '<span class="glyphicon glyphicon-thumbs-up"></span> Approved';
				$action = 'Trade';
			} else if($invoice->status == 3) {
				$icon = '<span class="glyphicon glyphicon-globe"></span> Traded';
				$action = 'Remove';
			} else if($invoice->status == 4) {
				$icon = '<span class="glyphicon glyphicon-ok"></span> Purchased';
				$action = 'View Details';
			} else if($invoice->status == 5) {
				$icon = '<span class="glyphicon glyphicon-flag"></span> Expired';
				$action = 'View Details';
			}
			echo '<tr>';
			echo '<td>'.$icon.'</td>';
			echo '<td>'.$invoice->invoice_id.'</td>';
			echo '<td>'.$invoice->number.'</td>';
  			echo '<td>£'.$invoice->value.'</td>';
  			echo '<td>'.$invoice->invoice_length.'</td>';
  			echo '<td>'.$invoice->issue_date.'</td>';
  			echo '<td>'.$invoice->payment_date.'</td>';
  			echo '<td>'.$invoice->expected_date.'</td>';
  			echo '<td>£'.$totalfees.'</td>';
  			echo '<td></td>';
  			echo '<td>'.$invoice->pub_date.'</td>';
  			echo '<td style="text-align:center;"><a href="#"><span class="glyphicon glyphicon-menu-hamburger"></span></a></td>';
			echo '</tr>';
		}
  	?>
  	</table>
  </div>
</div>


<?php include('_footer.php'); ?>
