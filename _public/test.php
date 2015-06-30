<?php
class Timer {
    private $time = null;
    public function __construct() {
        $this->time = time();
        echo 'Working - please wait..<br/>';
    }

    public function __destruct() {
        echo '<br/>Job finished in '.(time()-$this->time).' seconds.';
    }
}

/* --------------------------
* new stuff
----------------------------- */
function abcConv($letter) {
	if($letter==A) {

	} else if($letter==B) {}
}
$str1 = "abc";
$str2  = "abcd";
echo $comp = strcmp($str1, $str2);

// Returns < 0 if str1 < str2;
// Returns > 0 if str1 > str2
// 0 if they are equal.

$t = new Timer(); // echoes "Working, please wait.."
$maxLines = 30;
$maxcount = 850000;
$file1 = fopen('static/inc/BasicCompanyData-2015-06-01-part1_5.csv', 'r');
$file2 = fopen('static/inc/BasicCompanyData-2015-06-01-part2_5.csv', 'r');
/*
$myarr = array();
$ii = 0;
for ($i = 0; $i < 1000050001 && !feof($file2); $i = $i+10000)
{
    $line_of_text = fgetcsv($file2);
    //print '<div class="ticker_price">'. $line_of_text[0] . "</div>";
    array_push($myarr, $line_of_text[0]);
  	$i = $i+2;
}
		//echo '<pre>';
//print_r($myarr);
	 // echo '</pre>';
*/
require_once('config/setup.php');
$debtors = ORM::for_table('uk_companies')->where_gt('iduk_companies', 350000)->find_many();
foreach ($debtors as $debtor) {
    echo $debtor->company_name;
}
 /*$count = 0;
while (($line = fgetcsv($file2)) !== FALSE) {
  //$line is an array of the csv elements
 
        $newinv_db = ORM::for_table('uk_companies')->create();
        $newinv_db->company_name = $line[0];
        $newinv_db->save();
        
        if($count > 849999) {
        	echo '<pre>';
        	print_r($line);
        	echo '</pre>';
        }
	$count++;
}
echo $count;
fclose($file2);*/
unset($t);  // echoes "Job finished in n seconds." n = seconds elapsed*/


/* --------------------------
* My Custom One
----------------------------- */
/*
$t = new Timer();
		$needle = 'CURTIS-BARDEN LIMITED';
    $high = $maxLines-1;
    $low = 0;

    while (!strcmp($myarr[$high], $needle) == 0){
        $probe = ($high+$low)/2;
        if (strcmp($myarr[$probe], $needle) < 0){
            $low = $probe;
        }else{
            $high = $probe;
        }
    }

    echo $myarr[$high];
unset($t);*/
/* --------------------------
* new stuff
----------------------------- */

$arr=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14);
$searchfor = 6;
//echo binsearch($searchfor, $arr);

function binsearch($needle, $haystack)
{
    $high = count($haystack);
    $low = 0;
    
    while (strcmp($high, $low) == 0){
        $probe = ($high + $low) / 2;
        if ($haystack[$probe] < $needle){
            $low = $probe;
        }else{
            $high = $probe;
        }
    }

    if ($high == count($haystack) || $haystack[$high] != $needle) {
        return false;
    }else {
        return $high;
    }
}
$tE = binsearch($searchfor, $arr);
//echo $arr[$tE];
?>