<?php include('_header.php'); ?>

<div class="alert alertinfoinvestor" role="alert">
	Welcome <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_name']; ?>
	<div class="fr">
		<a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo WORDING_LOGOUT; ?></a> -
		<a href="edit.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo WORDING_EDIT_USER_DATA; ?></a>
	</div>
</div>
<div class="alert investorcash" role="alert">

</div>
<div class="inv-cont">
	<div class="inv-cont-main-title">Available Invoices</div>
	<div class="inv-cont-main">
		Following invoices have been approved for purchase.
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Seller</th>
				<th>Debtor</th>
				<th>Value</th>
				<th>% Allocation</th>
				<th>Yield</th>
				<th>Allocation</th>
				<th>Length</th>
				<th>Payment Due</th>
				<th>Discount</th>
				<th>Return</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$trades = ORM::for_table('trade')->where('status', 1)->find_many();
			foreach ($trades as $trade) {
				$invoice = ORM::for_table('invoice')->where('invoice_id', $trade->invoice_id)->find_one();
				$seller = ORM::for_table('company')->where('company_id', $invoice->invoice_company_id)->find_one();
				$debtor = ORM::for_table('company')->where('company_id', $invoice->debtor_company_id)->find_one();
				$count = ORM::for_table('trade')
					->where('trade_id', $trade->trade_id)
					->count()-1;
				echo '<tr>';
					echo '<td><a class="invoice_details_a" data-toggle="modal" data-target="#invoice_details" tradeid='.$trade->trade_id.'>'.$seller->name.'</a></td>';
					echo '<td>'.$debtor->name.'</td>';
					echo '<td>'.$invoice->value.'</td>';
					echo '<td>'.$trade->perc_allocation.'</td>';
					echo '<td>/</td>';
					echo '<td>'.$count.'</td>';
					echo '<td>'.$invoice->invoice_length.'</td>';
					echo '<td>'.$invoice->payment_date.'</td>';
					echo '<td>/</td>';
					echo '<td>/</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
	</div>
</div>

<div class="inv-cont">
	<div class="inv-cont-main-title">My Open Positions</div>
	<div class="inv-cont-main">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Seller</th>
				<th>Debtor</th>
				<th>Value</th>
				<th>% Allocation</th>
				<th>Yield</th>
				<th>Allocation</th>
				<th>Length</th>
				<th>Payment Due</th>
				<th>Discount</th>
				<th>Return</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$trades = ORM::for_table('trade')->where('status', 2)->where('purchase_user_id', $userid)->find_many();
			foreach ($trades as $trade) {
				$invoice = ORM::for_table('invoice')->where('invoice_id', $trade->invoice_id)->find_one();
				$seller = ORM::for_table('company')->where('company_id', $invoice->invoice_company_id)->find_one();
				$debtor = ORM::for_table('company')->where('company_id', $invoice->debtor_company_id)->find_one();
				$count = ORM::for_table('trade')
					->where('trade_id', $trade->trade_id)
					->count()-1;
				echo '<tr>';
					echo '<td><a class="invoice_details_a" data-toggle="modal" data-target="#invoice_details" tradeid='.$trade->trade_id.'>'.$seller->name.'</a></td>';
					echo '<td>'.$debtor->name.'</td>';
					echo '<td>'.$invoice->value.'</td>';
					echo '<td>'.$trade->perc_allocation.'</td>';
					echo '<td>/</td>';
					echo '<td>'.$count.'</td>';
					echo '<td>'.$invoice->invoice_length.'</td>';
					echo '<td>'.$invoice->payment_date.'</td>';
					echo '<td>/</td>';
					echo '<td>/</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
	</div>
</div>

<div class="inv-cont">
	<div class="inv-cont-main-title">My Closed Positions</div>
	<div class="inv-cont-main">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Seller</th>
				<th>Debtor</th>
				<th>Value</th>
				<th>% Allocation</th>
				<th>Yield</th>
				<th>Allocation</th>
				<th>Length</th>
				<th>Payment Due</th>
				<th>Discount</th>
				<th>Return</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$trades = ORM::for_table('trade')->where('status', 3)->where('purchase_user_id', $userid)->find_many();
			foreach ($trades as $trade) {
				$invoice = ORM::for_table('invoice')->where('invoice_id', $trade->invoice_id)->find_one();
				$seller = ORM::for_table('company')->where('company_id', $invoice->invoice_company_id)->find_one();
				$debtor = ORM::for_table('company')->where('company_id', $invoice->debtor_company_id)->find_one();
				$count = ORM::for_table('trade')
					->where('trade_id', $trade->trade_id)
					->count()-1;
				echo '<tr>';
					echo '<td><a class="invoice_details_a" data-toggle="modal" data-target="#invoice_details" tradeid='.$trade->trade_id.'>'.$seller->name.'</a></td>';
					echo '<td>'.$debtor->name.'</td>';
					echo '<td>'.$invoice->value.'</td>';
					echo '<td>'.$trade->perc_allocation.'</td>';
					echo '<td>/</td>';
					echo '<td>'.$count.'</td>';
					echo '<td>'.$invoice->invoice_length.'</td>';
					echo '<td>'.$invoice->payment_date.'</td>';
					echo '<td>/</td>';
					echo '<td>/</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="invoice_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Details</h4>
      </div>
      <div class="modal-body">
			</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function() {
		$('.invoice_details_a').click(function() {
			var tradeid = $(this).attr('tradeid');
			$( ".modal-body" ).load( "views/buyer_invoice_detail.php", { tradeid: tradeid  }, function() {

			});
		});
		$('#invoice_details').on('shown.bs.modal', function (e) {
		  // do something...
		})
	})
</script>

<?php include('_footer.php'); ?>
