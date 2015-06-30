<?php include('_header.php'); ?>

<div class="alert alertinfoinvestor" role="alert">
	Welcome <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_name']; ?>
	<div class="fr">
		<a href="index.php?logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo WORDING_LOGOUT; ?></a> - 
		<a href="edit.php"><span class="glyphicon glyphicon-wrench"></span> <?php echo WORDING_EDIT_USER_DATA; ?></a>
	</div>
</div>
<div class="alert investorcash" role="alert">
Equity £100,000
</div>
<div class="inv-cont">
	<div class="inv-cont-main-title">Available Invoices</div>
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
			<tr>
				<td>Mine Company</td>
				<td>Amazon.co.uk</td>
				<td>£120,000</td>
				<td>90%</td>
				<td>20%</td>
				<td>2</td>
				<td>30</td>
				<td>30/02/2018</td>
				<td>2%</td>
				<td>£2000</td>
			</tr>
			<tr>
				<td>Mine Company</td>
				<td>Amazon.co.uk</td>
				<td>£120,000</td>
				<td>90%</td>
				<td>20%</td>
				<td>2</td>
				<td>30</td>
				<td>30/02/2018</td>
				<td>2%</td>
				<td>£2000</td>
			</tr>
			<tr>
				<td>Mine Company</td>
				<td>Amazon.co.uk</td>
				<td>£120,000</td>
				<td>90%</td>
				<td>20%</td>
				<td>2</td>
				<td>30</td>
				<td>30/02/2018</td>
				<td>2%</td>
				<td>£2000</td>
			</tr>
		</tbody>
	</table>
	</div>
</div>

<div class="inv-cont">
	<div class="inv-cont-main-title">Open Positions</div>
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
			<tr>
				<td>Mine Company</td>
				<td>Amazon.co.uk</td>
				<td>£120,000</td>
				<td>90%</td>
				<td>20%</td>
				<td>2</td>
				<td>30</td>
				<td>30/02/2018</td>
				<td>2%</td>
				<td>£2000</td>
			</tr>
			<tr>
				<td>Mine Company</td>
				<td>Amazon.co.uk</td>
				<td>£120,000</td>
				<td>90%</td>
				<td>20%</td>
				<td>2</td>
				<td>30</td>
				<td>30/02/2018</td>
				<td>2%</td>
				<td>£2000</td>
			</tr>
			<tr>
				<td>Mine Company</td>
				<td>Amazon.co.uk</td>
				<td>£120,000</td>
				<td>90%</td>
				<td>20%</td>
				<td>2</td>
				<td>30</td>
				<td>30/02/2018</td>
				<td>2%</td>
				<td>£2000</td>
			</tr>
		</tbody>
	</table>
	</div>
</div>


<?php include('_footer.php'); ?>
