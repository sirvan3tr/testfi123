<?php include('_header.php'); ?>
<style type="text/css" src="static/datepicker/css/bootstrap-datepicker3.standalone.min.css" ></style>
<style type="text/css" src="static/datepicker/css/bootstrap-datepicker.min.css" ></style>

    <h1>New Invoice</h1>
    <p>Upload your invoice files in no time, upon successful submission we will review it and approve it in no time!</p>
    <hr />
    <form
        method="post"
        action="new_invoice.php"
        enctype="multipart/form-data"
        id="new_invoice_form"
        class="form-horizontal"
        name="new_invoice_form"
        onsubmit="return validateForm()"
    >
        <div class="form-group">
            <label for="customer" class="col-sm-1 control-label">Customer</label>
            <div class="col-sm-2">
                <select id="customer" name="customer" class="form-control">
                    <option value="false">--Select a customer</option>
                    <?php
                        $firmList = array();
                        $debtors = ORM::for_table('company')
                                    ->where('users_id', $person->user_id)
                                    ->where('company_type', 1)
                                    ->find_many();
                        foreach ($debtors as $debtor) {
                            echo '<option Value="'.$debtor->company_id.'">'.$debtor->name.'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-2"><button type="button" id="add_new_debtor" class="btn btn-default" data-toggle="modal" data-target="#newcomp">Add new customer</button></div>
        </div>
        <div class="form-group">
            <label for="invoice_number" class="col-sm-1 control-label">Invoice Number:</label>
            <div class="col-sm-2"><input id="invoice_number" type="text" name="invoice_number" class="form-control" onblur="isIntCheck('invoice_number')" required /></div>

            <label for="invoice_value" class="col-sm-1 control-label">Face Value:</label>
            <div class="col-sm-2"><input id="invoice_value" type="text" name="invoice_value" class="form-control" onblur="isIntCheck('invoice_value')" required /></div>

            <label for="invoice_length" class="col-sm-1 control-label">Invoice Length:</label>
            <div class="col-sm-2"><input id="invoice_length" type="text" name="invoice_length" class="form-control" onblur="isIntCheck('invoice_length')" required /></div>
        </div>
        <div class="form-group">
            <label for="issue_date" class="col-sm-1 control-label">Issue Date:</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input id="issue_date" type="text" name="issue_date" class="form-control datepicker" data-provide="datepicker" required />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <label for="payment_date" class="col-sm-1 control-label">Payment Date:</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input id="payment_date" type="text" name="payment_date" class="form-control datepicker" data-provide="datepicker" required />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <label for="expected_date" class="col-sm-1 control-label">Expected Date:</label>
            <div class="col-sm-2">
                <div class="input-group">
                    <input id="expected_date" type="text" name="expected_date" class="form-control datepicker" data-provide="datepicker" required />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-1 control-label">Description:</label>
            <div class="col-sm-4"><textarea id="description" class="form-control" name="description" required></textarea></div>
        </div>
        <hr />
        <p>Please upload .pdf, doc or docx files that are no larger than 5mb.</p>
        <div class="form-group">
            <label class="col-sm-1 control-label">Invoice file:</label>
            <div class="col-sm-2">
                <input type="file" name="invoice_file" id="invoice_file" required />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">Purchase Order:</label>
            <div class="col-sm-2">
                <input type="file" name="purchase_order" id="purchase_order" required />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">Other:</label>
            <div class="col-sm-2">
                <input type="file" name="other_file" id="other_file" required />
            </div>
        </div>
        <hr />
        <div class="form-group">
            <div class="col-sm-1"><input type="checkbox" required /></div>
            <div class="col-sm-4">I confirm that I have changed my bank details for this client whereby they will now pay into my account hosted by Funding Invoice.</div>
        </div>
        <div class="form-group">
            <div class="col-sm-1"><input type="checkbox" required /></div>
            <div class="col-sm-2">I consent to Funding Invoice verifying the uploaded invoices</div>
        </div>
        <div class="form-group">
            <div class="col-sm-1"><input type="checkbox" required /></div>
            <div class="col-sm-4">I consent to assigning all of the listed debts to Funding Invoice Ltd. and agree to Funding Invoice Ltd. allocating the debts to successful bids upon the closing of the trade. I, hereby, intimate to Funding Invoice Ltd. that each of the Scottish Debts listed by me (to the extent that there are any) and their Related Rights shall be the property of the Trust created under clause 2.11 of the Funding Invoice Laws.</div>
        </div>
        <div class="form-group">
            <div class="col-sm-1"><input type="checkbox" required /></div>
            <div class="col-sm-4">I confirm that I am fully authorised by the company or entity which I represent as part of this trade to be listing the uploaded invoice on the Funding Invoice Platform.Save</div>
        </div>
        <div class="form-group">
             <input type="submit" id="new_invoice_btn" name="new_invoice" class="btn btn-default" value="Submit" />
        </div>
    </form>
<script type="text/javascript" src="static/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    function validateForm() {
        var id = document.getElementById("customer"),
            x = id.value;
        if (isNaN(x) || x == null || x == '') {
            alert('Please ensure you have selected a customer.');
            id.focus();
            return false;
        }
    }

    function isIntCheck(el) {
        var x = document.getElementById(el).value;
        if(isNaN(x)) {
            alert('Value entered is not a number! Please try again.');
            document.getElementById(el).focus();
        }
    }

    $(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });

    });
</script>
<?php include('_footer.php'); ?>
