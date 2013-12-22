<?php

require('core.php'); // Reference the library

//NEED A TEXT FILE CALLED 'ipaddr.txt' with write permissions in the same directory as core.php


//Begin Iniate library
if (empty($_GET)) 
{
	HitCounter::set_store(); //Initiate an 'account' for current user if no ID refference attached
} else {
	$refid = $_GET['reff'];   //
	HitCounter::set_store();  // Otherwise start view-count update function
	HitCounter::hits($refid); //
}
//End Iniate library

//Common Usage:

echo HitCounter::hit_stat(); //Will echo the current number of unique view counts for the current user on the page
echo HitCounter::id_stat(); //Will echo the unique id of the current user logged in on the page

 ?>