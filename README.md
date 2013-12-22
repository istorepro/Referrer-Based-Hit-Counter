Hit-Counter
===========

A library that counts link visits by viewers, that is locked to a specific IP address.

```
// +---------------------------------------------------------------------------
// | Referrer-Based HitCounter Library v0.2
// | ========================================
// | by Glenn McGuire, 2013
// | https://github.com/glen-mac
// | ========================================
// +---------------------------------------------------------------------------
// | THIS LIBRARY IS FREE SOFTWARE
// | RELEASED UNDER THE: GNU GENERAL PUBLIC LICENSE (GPL) V2
// +---------------------------------------------------------------------------
// | > Feel free to edit, use and release this library
// | > Please do not use this library in commercial software
// | > Because proprietary software < Open Source
// +---------------------------------------------------------------------------
```

## Usage ##

```php
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
```
