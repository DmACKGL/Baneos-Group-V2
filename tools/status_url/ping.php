<?php
function statweb($text) {
 $word = array(
 "http://" => "",
 "www." => "",
 );
 foreach ($word as $bad => $good) {
 $text = str_replace($bad, $good, $text);
 }
 $oldurl = explode("/", $text);
 $newurl = $oldurl[0];
 $text = "$newurl";
 $text = strip_tags(addslashes($text));
 return $text;
 }
?>