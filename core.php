<?php
class LoL {

	public static function gen_num(){
	genstar:
	$digits_needed=8;
    $random_number=''; // set up a blank string
	$count=0;
    while ( $count < $digits_needed ) {
    $random_digit = mt_rand(0, 9);
    $random_number .= $random_digit;
    $count++; }
	return $random_number;
	}
	
	
    public function set_store() {
      $ip_address = $_SERVER['REMOTE_ADDR '];
       $visit_ip_file = file('ipaddr.txt');
	  $found_ip = false;
	  
    foreach($visit_ip_file as $ip) {
	  $pieces = explode("@", $ip);
          // echo trim ($ip).',';  -- for debugging purposes
$ip_item = trim($pieces[0]);
        // if(strpos($ip, $ip_address) != false) {
		 if ($ip_address==$ip_item) {
             $found_ip = true;
			 //echo " break ";
             break;
             }
		 else {
			 //echo " not ";
             $found_ip = false;
            }
         }
		 
        if ($found_ip == false) {
		$nhits = 0;
          //$filename = 'viewcount.txt';
          /*$handle = fopen($filename, 'r');
          $current = fread($handle, filesize($filename));
          echo $current; // for debugging - current value in counter
          fclose($handle);
          $current_inc = $current + 1;
          $handle = fopen($filename, 'w');
          fwrite($handle, $current_inc);
          fclose($handle);*/
		  //echo "store ";
         $handle = fopen('ipaddr.txt', 'a');
         fwrite($handle, $ip_address. "@" . LoL::gen_num() . "@" . $nhits.  "\n");
         fclose($handle);
     }
    } 
	
	public function updText($id){
	$file = "ipaddr.txt";
    $fh = fopen($file,'r+');
    // string to put username and passwords
    $linesu = '';
while(!feof($fh)) {
    $lineu = explode('@',fgets($fh));
    // take-off old "\r\n"
    $ipu = trim($lineu[0]);
    $idu = trim($lineu[1]);
	$hitsu = trim($lineu[2]);
    // check for empty indexes
    if (!empty($ipu) AND !empty($idu) AND !empty($hitsu)) {
        if ($idu == $id) {
            $hitsu = $hitsu + 1;
        }

        $linesu .= $ipu . '@' . $idu . '@' . $hitsu;
        $linesu .= "\r\n";
     }
}
// using file_put_contents() instead of fwrite()
file_put_contents('ipaddr.txt', $linesu);
fclose($fh); 
}
	
	
	
public function hits(){
	$id = $_GET['reff']; 
	$ip_address = $_SERVER['REMOTE_ADDR '];
	
	$ip_file = file('ipaddr.txt');
      foreach($ip_file as $line) {
	  $pieces = explode("@", $line);
          // echo trim ($ip).',';  -- for debugging purposes
         $id_item = trim($pieces[1]);
	 if ($id==$id_item) {
	 if ($ip_address = $pieces[0]){
	 break;
	 } else {
	 LoL::updText($id); }
	}}
}
}
?>

