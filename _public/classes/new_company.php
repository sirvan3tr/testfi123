<?php
      if (isset($_POST["new_company_sbmit"])) {

            $new_company = ORM::for_table('company')->create();

            $new_company->name = $_POST['company_name'];
            $new_company->industry = $_POST['industry'];
            $new_company->company_size = $_POST['comp_type'];
            $new_company->contact_name = $_POST['comp_type'];
            $new_company->contact_tel = $_POST['comp_type'];
            $new_company->contact_address_1 = $_POST['contact_adrs_1'];
            $new_company->contact_address_2 = $_POST['contact_adrs_2'];
            $new_company->contact_address_3 = $_POST['contact_adrs_3'];
            $new_company->contact_address_postcode = $_POST['postcode'];
            $new_company->company_type = 1;
            $new_company->users_id = $person->user_id;

            $new_company->save();
      }
?>