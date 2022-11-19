<?php 
if(!isset($_SESSION)) session_start();

echo "<div style='margin:15px;padding:30px 15px; border: solid 1px #ccc'; text-align:center>";
if(session_unset()){
  echo "Anda telah logout.<hr><a href='?'>Go to Login</a> | <a href='../'>Home PMB</a>";
  echo "<script ><>";
}else{
  echo "Error proses logout";
}

echo "</div>";


?>