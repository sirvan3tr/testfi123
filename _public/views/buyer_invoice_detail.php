<?php
$setup = realpath(__DIR__ . '/..').'/config/setup.php';
include($setup);

$trade = ORM::for_table('trade')->where('trade_id', $_REQUEST['tradeid'])->find_one();
$invoice = ORM::for_table('invoice')->where('invoice_id', $trade->invoice_id)->find_one();
$seller = ORM::for_table('company')->where('company_id', $invoice->invoice_company_id)->find_one();
$debtor = ORM::for_table('company')->where('company_id', $invoice->debtor_company_id)->find_one();
$count = ORM::for_table('trade')->where('trade_id', $trade->trade_id)->count()-1;
?>
<div class="row">
  <div class="col-md-8">
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
        </tr>
      </thead>
      <tbody>
    <?php
      echo '<tr>';
        echo '<td><a class="invoice_details_a" data-toggle="modal" data-target="#invoice_details" tradeid='.$trade->trade_id.'>'.$seller->name.'</a></td>';
        echo '<td>'.$debtor->name.'</td>';
        echo '<td>'.$invoice->value.'</td>';
        echo '<td>'.$trade->perc_allocation.'</td>';
        echo '<td>/</td>';
        echo '<td>'.$count.'</td>';
        echo '<td>'.$invoice->invoice_length.'</td>';
        echo '<td>'.$invoice->payment_date.'</td>';
      echo '</tr>';
    ?>
    </tbody>
	</table>
    Desired Allocation %:
    <input id="desired_allocation" type="text" value="" /> maximum <?php echo $trade->perc_allocation; ?>%
  </div>
  <div class="col-md-4">
    <div class="invoice_purchase_details">
      <table class="table">
        <tr><td>Chosen Allocation</td><td id="chosen_allocation" >30%</td></tr>
        <tr><td></td><td id="chosen_allocation_val">£35,150</td></tr>
        <tr><td>Discount rate</td><td>2%</td></tr>
        <tr><td>Gross return:</td><td id="gross_return">£35,853</td></tr>
        <tr><td>Gross profit:</td><td id="gross_profit">£703</td></tr>
        <tr><td>Funding Invoice Fees:</td><td>20%</td></tr>
        <tr><td></td><td id="fi_profit">£140.6</td></tr>
      </table>
    </div>
    <br />
    <div class="invoice_purchase_details">
      <table class="table">
        <tr><td>Return</td><td class="ipd_final" id="final_return">£35,712.4</td></tr>
        <tr><td>Profit</td><td class="ipd_final" id="final_profit">£562.4</td></tr>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    $( "#desired_allocation" ).keyup(function() {
      var val = $(this).val()/100;
      var disRate = 0.02;
      var faceval = <?php echo $invoice->value; ?>;
      var choAllVal = val*faceval;
      var grossReturn = (disRate*choAllVal)+choAllVal;
      var grossProfit = grossReturn-choAllVal;
      var fiProfit = grossProfit*0.2;
      $('#chosen_allocation').html(val*100);
      $('#chosen_allocation_val').html(choAllVal);
      $('#gross_return').html(grossReturn);
      $('#gross_profit').html(grossProfit);
      $('#fi_profit').html(fiProfit);
      $('#final_return').html(grossReturn-fiProfit);
      $('#final_profit').html(grossProfit-fiProfit);
    });
  })
</script>
