<?php
/**
 * Invoice
 * Handles the invoice registration and upload
 */

// Get list of companies associated with user and store in array
$firmList = array();
$debtors = ORM::for_table('company')
            ->where('users_id', $person->user_id)
            ->where('company_type', 1)
            ->find_many();
foreach ($debtors as $debtor) {
    $firmList[$debtor->company_id] = $debtor->company_size;
}

if (isset($_POST["new_invoice"])) {

    function sendVerificationEmail($htmlbody, $useremailad, $mailsubject) {
        $mail = new PHPMailer;
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->IsHTML(true);
        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($useremailad);
        $mail->Subject = $mailsubject;
        $mail->Body = $htmlbody;

        if(!$mail->Send()) {
            $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }
    // --------- END OF EMAIL FUNCTIONS ---------
    // All of the variables
    $customerid = $_POST['customer'];
    $invoicenum = $_POST['invoice_number'];
    $faceval = $_POST['invoice_value'];
    $issuedate = $_POST['issue_date'];
    $paymentdate = $_POST['payment_date'];
    $expecteddate = $_POST['expected_date'];
    $description = $_POST['description'];
    $invLength = $_POST['invoice_length'];

    $messages = array('First message.');
    $alluploadsOK = 0;

    // Setup directory for file upload
    // uploads/$YYYY/userId_$id/$timestamp_$date/
    $t = time().'_'.date("Y-m-d");
    $target_dir = "uploads/".date("Y")."/userId_".$person->user_id."/".$t."/";
    // Check if direcotry exists, else create it
    if (!file_exists($target_dir)) { mkdir($target_dir, 0755, true); }

    // ------------------------------ //
    // --- FILE UPLOAD VALIDATION --- //
    // ------------------------------ //

    $filesArray = ["invoice_file", "purchase_order", "other_file"];
    $fileError = [2, 2, 2];
    $fileNames = array();
    for ($i=0; $i < count($filesArray); $i++) {
        $target_file = $target_dir . basename($_FILES[$filesArray[$i]]["name"]);
        array_push($fileNames, basename($_FILES[$filesArray[$i]]["name"]));
        $uploadOk = 1;
        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            array_push($messages, "Sorry, file already exists.");
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["invoice_file"]["size"] > 5242880) { // 5MB
            array_push($messages, "Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($fileType != "pdf" && $fileType != "docx" && $fileType != "doc"
        && $fileType != "gif" && $fileType != "jpg" && $fileType != "png"
        && $fileType != "jpeg") {
            array_push($messages, "Sorry, only PDF, doc, docx, jpg, jpeg, png and gif file formats are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            array_push($messages, "Sorry, your file was not uploaded.");
            // There was an error, delete ull uploaded files.
            for ($i=0; $i < count($filesArray); $i++) {
                $thefile = $target_dir . basename($_FILES[$filesArray[$i]]["name"]);
                unlink($thefile);
            }
            rmdir($target_dir);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$filesArray[$i]]["tmp_name"], $target_file)) {
                array_push($messages, "The file ". basename( $_FILES[$filesArray[$i]]["name"]). " has been uploaded.");
                $fileError[$i] = 1;
            } else {
                array_push($messages, "Sorry, there was an error uploading your file.");
                // There was an error, delete ull uploaded files.
                for ($i=0; $i < count($filesArray); $i++) {
                    $thefile = $target_dir . basename($_FILES[$filesArray[$i]]["name"]);
                    unlink($thefile);
                }
                rmdir($target_dir);
            }
        }
        
    } // end of for loop

    // if sum is 3 then there is a successful upload of all files.
    $sum = array_sum($fileError);
    array_push($messages, $sum);
    if($sum == 3) {
        $compSize = $firmList[$customerid];
        $invvallength = $invLength*$faceval;
        if ($compSize==1) {
            $buyerfee = (0.0125/30)*$invvallength;
        } else if($compSize==2) {
            $buyerfee = (0.0165/30)*$invvallength;
        } else if($compSize==3) {
            $buyerfee = (0.0215/30)*$invvallength;
        } else if($compSize==4) {
            $buyerfee = (0.0250/30)*$invvallength;
        }
        array_push($messages, $buyerfee);
        $newinv_db = ORM::for_table('invoice')->create();

        $newinv_db->number = $invoicenum;
        $newinv_db->value = $faceval;
        $newinv_db->issue_date = $issuedate;
        $newinv_db->payment_date = $paymentdate;
        $newinv_db->expected_date = $expecteddate;
        $newinv_db->description = $description;
        $newinv_db->invoice_company_id = $customerid;
        $newinv_db->debtor_company_id = $customerid;
        $newinv_db->author_id = $person->user_id;
        $newinv_db->invoice_length = $invLength;
        $newinv_db->file_dir = $target_dir;
        $newinv_db->listing_fee = 0;
        $newinv_db->buyer_fee = $buyerfee;

        $newinv_db->save();

        $lastInv = ORM::for_table('invoice')
            ->where('author_id', $person->user_id)
            ->where('file_dir', $target_dir)
            ->find_one();
        // Submit Files name to invoice_fie db table
        for ($i=0; $i < count($fileNames); $i++) {
            $newinv_files = ORM::for_table('invoice_files')->create();

            $newinv_files->file_name = $fileNames[$i];
            $newinv_files->file_location = $target_dir;
            $newinv_files->invoice_id = $lastInv->invoice_id;


            $newinv_files->save();
        }
        $messages[0] = 'Your invoice has been uploaded for review, please await our confirmation!';
        $htmltextun = '<table>'
            .'<tr style="font-size:20px; font-weight:bold;text-align:center;">'
                .'<td>Funding Invoice</td>'
            .'</tr>'
            .'<tr>'
                .'<td style="text-align:center;">'
                   .' <a href="http://fundinginvoice.com">Home</a> - '
                    .'<a href="http://fundinginvoice.com/platform/">Login to platform</a> - '
                    .'<a href="#home">Help</a> - '
                    .'<a href="http://fundinginvoice.com/contact/">Contact Us</a>'
                .'</td>'
            .'</tr>'
            .'<tr>'
                .'<td>'
                    .'<span style="font-size:16px;font-weight:bold;">Invoice Submission Confirmation</span><br />'
                    .'This is an email confirmation that your invoice has been submitted for a review, we will '
                    .'review and approve this invoice as soon as possible, Thank you!'
                .'</td>'
            .'</tr>'
        .'</table>'
        .'<table border="0" style="width: 100%;text-align: center;font-size: 14px;margin-top:10px;">'
            .'<tbody>'
                .'<tr>'
                    .'<td style="border-right: 1px solid #ccc;">Face Value</td>'
                   .' <td style="border-right: 1px solid #ccc;">Listing Fee</td>'
                    .'<td>Investor Fee</td>'
                .'</tr>'
                .'<tr style="font-size: 18px;font-weight: bold;">'
                    .'<td style="border-right: 1px solid #ccc;">£'.$faceval.'</td>'
                    .'<td style="border-right: 1px solid #ccc;">FREE</td>'
                    .'<td>£'.$buyerfee.'</td>'
                .'</tr>'
            .'</tbody>'
        .'</table>';
        sendVerificationEmail($htmltextun, $person->user_email, 'FI - New Invoice Confirmation');
    } else {
        $messages[0] = 'An error has occured, please ensure all fields are correctly filled in.';
    }
}
?>