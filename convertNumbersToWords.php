<?php
/**
 * n2w.php
 *
 * php function to convert numbers to words
 * @author Jeff Hendrickson JKH <jeff@hendricom.com>
 * @version 1.0
 * @package n2w
 */

function convertNumberToWords($number) {

    $words = array(
    '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
    '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
    '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
    '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
    '30' => 'thirty','40' => 'forty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
    '80' => 'eighty','90' => 'ninety');
    
    // find the length of the number
    $number_length = strlen($number);
    // initialize an empty array, to nine spaces
    $number_array = array(0,0,0,0,0,0,0,0,0);        
    $received_number_array = array();
    
    // store all received numbers into an array
    for($i=0;$i<$number_length;$i++) {    
  		$received_number_array[$i] = substr($number,$i,1);    
  	}

    // populate the empty array with the numbers received 
    for($i=9-$number_length,$j=0;$i<9;$i++,$j++) { 
        $number_array[$i] = $received_number_array[$j]; 
    }

    // a place for our answer
    $number_to_words_string = "";
    // determine if is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded 
    // with 7 multiply 1 by 10 and add 7 to it.
    for($i=0,$j=1;$i<9;$i++,$j++){
        // e.g.
        // "01,23,45,6,78"
        // "00,10,06,7,42"
        // "00,01,90,0,00"
        if($i==0 || $i==2 || $i==4 || $i==7) {
            if($number_array[$j]==0 || $number_array[$i] == "1") {
                $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
                $number_array[$i] = 0;
            }
               
        }
    }

    $value = "";
    for($i=0;$i<9;$i++) {
        if($i==0 || $i==2 || $i==4 || $i==7) {    
            $value = $number_array[$i]*10; 
        }
        else{ 
            $value = $number_array[$i];    
        }            
        if($value!=0)         {    $number_to_words_string.= $words["$value"]." "; }
        if($i==1 && $value!=0){    $number_to_words_string.= "billion "; }
        if($i==3 && $value!=0){    $number_to_words_string.= "million ";    }
        if($i==5 && $value!=0){    $number_to_words_string.= "thousand "; }
        if($i==6 && $value!=0){    $number_to_words_string.= "hundred "; }            

    }
    if($number_length>9) { 
        $number_to_words_string = "Sorry This does not support more than billion"; 
    }
    
    return $number_to_words_string;
}


  echo convertNumberToWords("9") . PHP_EOL;

  echo convertNumberToWords("19") . PHP_EOL;

  echo convertNumberToWords("75") . PHP_EOL;
  
  echo convertNumberToWords("132") . PHP_EOL; 
  
  echo convertNumberToWords("4032") . PHP_EOL;  
  
  echo convertNumberToWords("19999") . PHP_EOL; 
    
?>