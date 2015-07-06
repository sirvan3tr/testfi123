<!-- Modal -->
<div class="modal fade" id="newcomp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Company</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-horizontal" name="new_company" id="new_company_form">
          <input type="hidden" value="<?php echo $person->user_id; ?>"  name="userid" id="new_comp_userid" />
          <input type="hidden" value="new_company_sbmit"  name="new_company_sbmit" id="new_company_sbmit" />
          <div class="form-group">
            <label for="company_name" class="col-sm-2 control-label">Company Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" required />
            </div>
          </div>
          <div class="form-group">
            <label for="company_number" class="col-sm-2 control-label">Company Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company_number" placeholder="Company Number" name="company_number">
            </div>
          </div>
          <div class="form-group">
            <label for="revenue" class="col-sm-2 control-label">Last Year Revenue</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="revenue" placeholder="Previous 4 Quarters Revenue" name="revenue"  required />
            </div>
          </div>
          <div class="form-group">
            <label for="industry" class="col-sm-2 control-label">Industry</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="industry" placeholder="Industry" name="industry" required />
            </div>
          </div>
          <div class="form-group">
            <label for="comp_type" class="col-sm-2 control-label">Type/Size</label>
            <div class="col-sm-10">
              <select name="comp_type" id="comp_type" class="form-control" required>
                <option value="1">Corporate</option>
                <option value="2">Large</option>
                <option value="3">Medium</option>
                <option value="4">Small</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="contact_name" class="col-sm-2 control-label">Contact Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_name" placeholder="Contact Name" name="contact_name" required />
            </div>
          </div>
          <div class="form-group">
            <label for="contact_tel" class="col-sm-2 control-label">Contact Tel</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_tel" placeholder="Contact Tel" name="contact_tel" required />
            </div>
          </div>
          <div class="form-group">
            <label for="contact_adrs_1" class="col-sm-2 control-label">Contact Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_adrs_1" placeholder="Contact Address" name="contact_adrs_1" required />
            </div>
          </div>
          <div class="form-group">
            <label for="contact_adrs_2" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_adrs_2" placeholder="Address 2" name="contact_adrs_2" required />
            </div>
          </div>
          <div class="form-group">
            <label for="contact_adrs_3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_adrs_3" placeholder="Address 3" name="contact_adrs_3" required />
            </div>
          </div>
          <div class="form-group">
            <label for="postcode" class="col-sm-2 control-label">Post Code</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="postcode" placeholder="Post Code" name="postcode" required />
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" id="postregister_btn" name="new_company" class="btn btn-primary" value="Submit" />
      </div>
        </form>
    </div>
  </div>
</div>
