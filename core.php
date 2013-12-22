<?php

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

class HitCounter
{

  public static function gen_num()
  {
    $digits_needed = 8;
    $random_number = '';
    $count         = 0;
    while ($count < $digits_needed)
    {
      $random_digit = mt_rand(0, 9);
      $random_number .= $random_digit;
      $count++;
    }
    return $random_number;
  }
  
  public function set_store()
  {
    $ip_address    = $_SERVER['REMOTE_ADDR'];
    $visit_ip_file = file('ipaddr.txt');
    $found_ip      = false;
    
    foreach ($visit_ip_file as $ip)
    {
      $pieces  = explode("@", $ip);
      $ip_item = trim($pieces[0]);
      if ($ip_address == $ip_item)
      {
        $found_ip = true;
        break;
      }
      else
      {
        $found_ip = false;
      }
    }
    
    if ($found_ip == false)
    {
      $nhits  = 0;
      $handle = fopen("ipaddr.txt", 'a');
      fwrite($handle, $ip_address . "@" . self::gen_num() . "@" . $nhits . "\n");
      fclose($handle);
    }
  }
  
  public static function updText($idea, $hitz, $iop)
  {
    $hitz     = trim($hitz);
    $filedata = file('ipaddr.txt');
    $newdata  = array();
    $lookfor  = $iop . "@" . $idea . "@" . $hitz;
    $newtext  = $iop . "@" . $idea . "@" . ($hitz + 1);

    foreach ($filedata as $filerow)
    {
      if (strstr($filerow, $lookfor) !== false)
      {
        $filerow = $newtext . "\n";
      }
      $newdata[] = $filerow;
    }
    $newdata = array_filter($newdata);
    file_put_contents("ipaddr.txt", "");
    $handle = fopen("ipaddr.txt", 'a+');
    $lim = (count($newdata));
    $fp = fopen("ipaddr.txt", "w+");
    foreach ($newdata as $key => $value)
    {
      fwrite($fp, $value);
    }
    fclose($handle);
  }
  
  public static function hits($nvar)
  {
    $nnvar      = $nvar;
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ip_file    = file('ipaddr.txt');
    foreach ($ip_file as $lin)
    {
      $piec    = explode("@", $lin);
      $newip   = trim($piec[0]);
      $id_item = trim($piec[1]);
      $cur_hit = trim($piec[2]);
      if ($id_item == $nnvar)
      {
        if ($ip_address == $newip)
        {
          break;
        }
        else
        {
          self::updText($nnvar, $cur_hit, $newip);
          break;
          
        }
      }
    }
    
  }
  
  public static function hit_stat()
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ipa_file   = file('ipaddr.txt');
    foreach ($ipa_file as $liner)
    {
      $piec    = explode("@", $liner);
      $newip   = trim($piec[0]);
      $cur_hit = strval(trim($piec[2]));
      if ($ip_address == $newip)
      {
        return $cur_hit;
      }
    }
  }
  
  public static function id_stat()
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ipa_file   = file('ipaddr.txt');
    foreach ($ipa_file as $liner)
    {
      $piec    = explode("@", $liner);
      $newip   = trim($piec[0]);
      $uniq_id = strval(trim($piec[1]));
      if ($ip_address == $newip)
      {
        return $uniq_id;
      }
    }
  }
  
}

?>