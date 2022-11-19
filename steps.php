<?php 
$im3 = "<img src='assets/img/icons/3.png' height=25px>";
$im4 = "<img src='assets/img/icons/4.png' height=25px>";
$im5 = "<img src='assets/img/icons/5.png' height=25px>";
$im6 = "<img src='assets/img/icons/6.png' height=25px>";
$im7 = "<img src='assets/img/icons/7.png' height=25px>";
$im8 = "<img src='assets/img/icons/8.png' height=25px>";
$im9 = "<img src='assets/img/icons/9.png' height=25px>";

$next_btn = "<img src='assets/img/icons/next_btn.png' height=25px>";
$prev_btn = "<img src='assets/img/icons/prev_btn.png' height=25px>";

$step3 = "<a href='?p=daftar3'>$im3</a>";
$step4 = "<a href='?p=daftar4'>$im4</a>";
$step5 = "<a href='?p=daftar5'>$im5</a>";
$step6 = "<a href='?p=daftar6'>$im6</a>";
$step7 = "<a href='?p=daftar7'>$im7</a>";
$step8 = "<a href='?p=daftar8'>$im8</a>";
$step9 = "<a href='?p=daftar9'>$im9</a>";


switch ($cstep) {
	case '3': $step3 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
	case '4': $step4 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
	case '5': $step5 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
	case '6': $step6 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
	case '7': $step7 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
	case '8': $step8 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
	case '9': $step9 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";break;
}

//$cstep2 = " | <b><span style='color:blue'>Step $cstep</span></b> | ";

$step_prev=$cstep-1;
$step_next=$cstep+1;
$step_prev = "<a href='?p=daftar$step_prev'>$prev_btn</a>";
$step_next = "<a href='?p=daftar$step_next'>$next_btn</a>";

if ($cstep==3) $step_prev="";
if ($cstep==9) $step_next="";

?>

<div class="row">
  <div class="col-md-10">
    <?php echo "
    $step_prev
    $step3 
    $step4 
    $step5 
    $step6 
    $step7 
    $step8 
    $step9 
    $step_next
    "; ?> 

  </div>
  
</div>