<!-- Modal -->
<div class="modal fade" id="newcomp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Company</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="new_company_form">
          <input type="hidden" value="<?php echo $person->user_id; ?>"  name="userid" id="new_comp_userid" />
          <input type="hidden" value="new_company_sbmit"  name="new_company_sbmit" id="new_company_sbmit" />
          <div class="form-group">
            <label for="company_name" class="col-sm-2 control-label">Company Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name">
            </div>
          </div>
          <div class="form-group">
            <label for="industry" class="col-sm-2 control-label">Industry</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="industry" placeholder="Industry" name="industry">
            </div>
          </div>
          <div class="form-group">
            <label for="comp_type" class="col-sm-2 control-label">Type/Size</label>
            <div class="col-sm-10">
              <select name="comp_type" id="comp_type" class="form-control">
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
              <input type="text" class="form-control" id="contact_name" placeholder="Contact Name" name="contact_name">
            </div>
          </div>
          <div class="form-group">
            <label for="contact_tel" class="col-sm-2 control-label">Contact Tel</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_tel" placeholder="Contact Tel" name="contact_tel">
            </div>
          </div>
          <div class="form-group">
            <label for="contact_adrs_1" class="col-sm-2 control-label">Contact Address</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_adrs_1" placeholder="Contact Address" name="contact_adrs_1">
            </div>
          </div>
          <div class="form-group">
            <label for="contact_adrs_2" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_adrs_2" placeholder="Address 2" name="contact_adrs_2">
            </div>
          </div>
          <div class="form-group">
            <label for="contact_adrs_3" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact_adrs_3" placeholder="Address 3" name="contact_adrs_3">
            </div>
          </div>
          <div class="form-group">
            <label for="postcode" class="col-sm-2 control-label">Post Code</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="postcode" placeholder="Post Code" name="postcode">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="new_company_btn">Submit</button>
      </div>
    </div>
  </div>
</div>